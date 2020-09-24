<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional;

use GuzzleHttp\Client;
use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\CoinbaseAccounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Currencies;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Deposits;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Fees;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Fills;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Limits;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Margin;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\MarginApiReadyCheckDecorator;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Oracle;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Orders;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\PaymentMethods;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Products;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Profiles;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Reports;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\StableCoinConversions;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Time;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\UserAccount;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Withdrawals;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use Symfony\Component\Yaml\Yaml;

final class ApiFactory
{
    const CONFIG_ROOT_CONNECTIVITY = 'connectivity';
    const CONFIG_ROOT_FEATURES = 'features';
    const CONFIG_ROOT_REMOTE_TIME = 'remote_time';
    const CONFIG_ROOT_MANAGE_RATE_LIMITS = 'manage_rate_limits';
    const CONFIG_ROOTS = [
        self::CONFIG_ROOT_CONNECTIVITY,
        self::CONFIG_ROOT_FEATURES,
        self::CONFIG_ROOT_REMOTE_TIME,
        self::CONFIG_ROOT_MANAGE_RATE_LIMITS,
    ];

    const CONFIG_CONNECTIVITY_FIELDS = [
        'endpoint',
        'key',
        'secret',
        'passphrase',
    ];

    const CONFIG_FEATURES_FIELDS = [
        'accounts',
        'coinbase_accounts',
        'currencies',
        'deposits',
        'fees',
        'fills',
        'limits',
        'margin',
        'oracle',
        'orders',
        'payment_methods',
        'products',
        'profiles',
        'reports',
        'stablecoin_conversions',
        'time',
        'user_accounts',
        'withdrawals',
    ];

    public static function create(
        string $endpoint,
        string $key,
        string $secret,
        string $passphrase,
        bool $activateAccounts,
        bool $activateCoinbaseAccounts,
        bool $activateCurrencies,
        bool $activateDeposits,
        bool $activateFees,
        bool $activateFills,
        bool $activateLimits,
        bool $activateMargin,
        bool $activateOracle,
        bool $activateOrders,
        bool $activatePaymentMethods,
        bool $activateProducts,
        bool $activateProfiles,
        bool $activateReports,
        bool $activateStableCoinConversions,
        bool $activateTime,
        bool $activateUserAccounts,
        bool $activateWithdrawals,
        bool $useCoinbaseRemoteTime = false,
        bool $manageRateLimits = true
    ): ApiConnectivityInterface {
        $apiParams = new ApiParams($endpoint, $key, $secret, $passphrase);
        $requestManager = new RequestFactory(new Client(), $apiParams, $manageRateLimits);

        $time = new Time($requestManager);

        if ($useCoinbaseRemoteTime) {
            $requestManager->setTimeInterface($time);
        }

        return new ApiConnectivity(
            $activateAccounts ? new Accounts($requestManager) : null,
            $activateCoinbaseAccounts ? new CoinbaseAccounts($requestManager) : null,
            $activateCurrencies ? new Currencies($requestManager) : null,
            $activateDeposits ? new Deposits($requestManager) : null,
            $activateFees ? new Fees($requestManager) : null,
            $activateFills ? new Fills($requestManager) : null,
            $activateLimits ? new Limits($requestManager) : null,
            $activateMargin ? new MarginApiReadyCheckDecorator(new Margin($requestManager)) : null,
            $activateOracle ? new Oracle($requestManager) : null,
            $activateOrders ? new Orders($requestManager) : null,
            $activatePaymentMethods ? new PaymentMethods($requestManager) : null,
            $activateProducts ? new Products($requestManager) : null,
            $activateProfiles ? new Profiles($requestManager) : null,
            $activateReports ? new Reports($requestManager) : null,
            $activateStableCoinConversions ? new StableCoinConversions($requestManager) : null,
            $activateTime ? $time : null,
            $activateUserAccounts ? new UserAccount($requestManager) : null,
            $activateWithdrawals ? new Withdrawals($requestManager) : null
        );
    }

    public static function createFull(
        string $endpoint,
        string $key,
        string $secret,
        string $passphrase,
        bool $useCoinbaseRemoteTime = false,
        bool $manageRateLimits = true
    ): ApiConnectivityInterface {
        return self::create(
            $endpoint,
            $key,
            $secret,
            $passphrase,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            true,
            $useCoinbaseRemoteTime,
            $manageRateLimits
        );
    }

    public static function createFromYamlConfig(string $path): ApiConnectivityInterface
    {
        $config = self::parseYamlConfigFile($path);
        self::checkConfig($config);

        $useCoinbaseRemoteTime = (
            isset($config[self::CONFIG_ROOT_REMOTE_TIME])
            && true === $config[self::CONFIG_ROOT_REMOTE_TIME]
        );
        $manangeRateLimits = (
            isset($config[self::CONFIG_ROOT_MANAGE_RATE_LIMITS])
            && false === $config[self::CONFIG_ROOT_MANAGE_RATE_LIMITS]
        ) ? false : true;

        if (true === $config[self::CONFIG_ROOT_FEATURES] || !isset($config[self::CONFIG_ROOT_FEATURES])) {
            return self::createFull(
                $config[self::CONFIG_ROOT_CONNECTIVITY][self::CONFIG_CONNECTIVITY_FIELDS[0]],
                $config[self::CONFIG_ROOT_CONNECTIVITY][self::CONFIG_CONNECTIVITY_FIELDS[1]],
                $config[self::CONFIG_ROOT_CONNECTIVITY][self::CONFIG_CONNECTIVITY_FIELDS[2]],
                $config[self::CONFIG_ROOT_CONNECTIVITY][self::CONFIG_CONNECTIVITY_FIELDS[3]],
                $useCoinbaseRemoteTime,
                $manangeRateLimits
            );
        }

        $params = [
            $config[self::CONFIG_ROOT_CONNECTIVITY][self::CONFIG_CONNECTIVITY_FIELDS[0]],
            $config[self::CONFIG_ROOT_CONNECTIVITY][self::CONFIG_CONNECTIVITY_FIELDS[1]],
            $config[self::CONFIG_ROOT_CONNECTIVITY][self::CONFIG_CONNECTIVITY_FIELDS[2]],
            $config[self::CONFIG_ROOT_CONNECTIVITY][self::CONFIG_CONNECTIVITY_FIELDS[3]],
        ];

        foreach (self::CONFIG_FEATURES_FIELDS as $CONFIG_FEATURES_FIELD) {
            if (false === $config[self::CONFIG_ROOT_FEATURES]) {
                $params[] = false;

                continue;
            }
            $params[] = (
                !isset($config[self::CONFIG_ROOT_FEATURES][$CONFIG_FEATURES_FIELD])
                || !(false === $config[self::CONFIG_ROOT_FEATURES][$CONFIG_FEATURES_FIELD])
            );
        }

        $params[] = $useCoinbaseRemoteTime;
        $params[] = $manangeRateLimits;

        return self::create(...$params);
    }

    private static function parseYamlConfigFile(string $path): array
    {
        if (!file_exists($path)) {
            throw new ApiError(sprintf('Config file %s not found', $path));
        }

        try {
            $config = Yaml::parseFile($path);
        } catch (\Throwable $exception) {
            throw new ApiError($exception->getMessage());
        }

        return $config;
    }

    private static function checkConfig(array $config): void
    {
        $config = array_filter($config, function ($key) {
            return in_array($key, self::CONFIG_ROOTS);
        }, ARRAY_FILTER_USE_KEY);

        foreach (self::CONFIG_CONNECTIVITY_FIELDS as $connectivityFields) {
            if (!isset($config[self::CONFIG_ROOT_CONNECTIVITY])
                || !is_array($config[self::CONFIG_ROOT_CONNECTIVITY])
                || !isset($config[self::CONFIG_ROOT_CONNECTIVITY][$connectivityFields])
            ) {
                throw new ApiError(sprintf('Config file must contain %s key in connectivity root key.', $connectivityFields));
            }
        }

        foreach ($config[self::CONFIG_ROOT_CONNECTIVITY] as $k => $v) {
            if (!in_array($k, self::CONFIG_CONNECTIVITY_FIELDS)) {
                continue;
            }
            preg_match('#^\$\{(.+)\}$#', $v, $matches);
            if (isset($matches[1])) {
                $config[self::CONFIG_ROOT_CONNECTIVITY][$k] = getenv($matches[1]);
            }
        }

        if (!isset($config[self::CONFIG_ROOT_FEATURES])
            || !(
                is_array($config[self::CONFIG_ROOT_FEATURES])
                || is_bool($config[self::CONFIG_ROOT_FEATURES])
            )
        ) {
            throw new ApiError('Config file features root key must be an array or a boolean value.');
        }
    }
}
