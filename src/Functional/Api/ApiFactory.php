<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Api;

use GuzzleHttp\Client;
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Functional\Api\Config\Config;
use MockingMagician\CoinbaseProSdk\Functional\Api\Config\Params;
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
use MockingMagician\CoinbaseProSdk\Functional\Request\RequestFactory;
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

    const CONFIG_FEATURES_FIELDS_MAPPING = [
        'accounts' => 'accounts',
        'coinbase_accounts' => 'coinbaseAccounts',
        'currencies' => 'currencies',
        'deposits' => 'deposits',
        'fees' => 'fees',
        'fills' => 'fills',
        'limits' => 'limits',
        'margin' => 'margin',
        'oracle' => 'oracle',
        'orders' => 'orders',
        'payment_methods' => 'paymentMethods',
        'products' => 'products',
        'profiles' => 'profiles',
        'reports' => 'reports',
        'stablecoin_conversions' => 'stablecoinConversions',
        'time' => 'time',
        'user_account' => 'userAccount',
        'withdrawals' => 'withdrawals',
    ];

    public static function create(
        string $endpoint,
        string $key,
        string $secret,
        string $passphrase,
        ?Config $apiConfig = null
    ): ApiInterface {
        if (is_null($apiConfig)) {
            $apiConfig = new Config();
        }

        $apiParams = new Params($endpoint, $key, $secret, $passphrase);

        $requestManager = new RequestFactory(new Client(), $apiParams, $apiConfig->isManageRateLimits());

        $time = new Time($requestManager);

        if ($apiConfig->isUseCoinbaseRemoteTime()) {
            $requestManager->setTimeInterface($time);
        }

        return new CoinbaseApi(
            $apiConfig->getConnectivityConfig()->getAccounts() ? new Accounts($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getCoinbaseAccounts() ? new CoinbaseAccounts($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getCurrencies() ? new Currencies($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getDeposits() ? new Deposits($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getFees() ? new Fees($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getFills() ? new Fills($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getLimits() ? new Limits($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getMargin() ? new MarginApiReadyCheckDecorator(new Margin($requestManager)) : null,
            $apiConfig->getConnectivityConfig()->getOracle() ? new Oracle($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getOrders() ? new Orders($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getPaymentMethods() ? new PaymentMethods($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getProducts() ? new Products($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getProfiles() ? new Profiles($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getReports() ? new Reports($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getStableCoinConversions() ? new StableCoinConversions($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getTime() ? $time : null,
            $apiConfig->getConnectivityConfig()->getUserAccount() ? new UserAccount($requestManager) : null,
            $apiConfig->getConnectivityConfig()->getWithdrawals() ? new Withdrawals($requestManager) : null
        );
    }

    public static function createFromYamlConfig(string $path): ApiInterface
    {
        $config = self::parseYamlConfigFile($path);
        self::checkConfig($config);

        $apiConfig = new Config();

        if (isset($config[self::CONFIG_ROOT_REMOTE_TIME])) {
            $apiConfig->setManageRateLimits((bool) $config[self::CONFIG_ROOT_REMOTE_TIME]);
        }

        if (isset($config[self::CONFIG_ROOT_MANAGE_RATE_LIMITS])) {
            $apiConfig->setUseCoinbaseRemoteTime((bool) $config[self::CONFIG_ROOT_MANAGE_RATE_LIMITS]);
        }

        self::configureConnectivity($config, $apiConfig);

        return self::create(
            $config[self::CONFIG_ROOT_CONNECTIVITY][self::CONFIG_CONNECTIVITY_FIELDS[0]],
            $config[self::CONFIG_ROOT_CONNECTIVITY][self::CONFIG_CONNECTIVITY_FIELDS[1]],
            $config[self::CONFIG_ROOT_CONNECTIVITY][self::CONFIG_CONNECTIVITY_FIELDS[2]],
            $config[self::CONFIG_ROOT_CONNECTIVITY][self::CONFIG_CONNECTIVITY_FIELDS[3]],
            $apiConfig
        );
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
    }

    private static function configureConnectivity(array $config, Config $apiConfig): void
    {
        if (!isset($config[self::CONFIG_ROOT_FEATURES]) || !is_array($config[self::CONFIG_ROOT_FEATURES])) {
            return;
        }

        foreach (self::CONFIG_FEATURES_FIELDS_MAPPING as $key => $methodPart) {
            if (!isset($config[self::CONFIG_ROOT_FEATURES][$key])) {
                continue;
            }

            if (false === $config[self::CONFIG_ROOT_FEATURES][$key]) {
                $apiConfig->{'set'.ucfirst($methodPart)}(false);
            }
        }
    }
}
