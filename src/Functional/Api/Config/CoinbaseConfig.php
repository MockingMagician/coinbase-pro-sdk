<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Api\Config;


use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ConfigInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ConnectivityConfigInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ParamsInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use Symfony\Component\Yaml\Yaml;

class CoinbaseConfig extends AbstractConfig implements ConfigInterface
{
    const CONFIG_ROOT_PARAMS = 'params';
    const CONFIG_ROOT_CONNECTIVITY = 'connectivity';
    const CONFIG_ROOT_REMOTE_TIME = 'remote_time';
    const CONFIG_ROOT_MANAGE_RATE_LIMITS = 'manage_rate_limits';
    const CONFIG_ROOT_SECURE_PARAMS = 'secure_params';
    const CONFIG_ROOTS = [
        self::CONFIG_ROOT_PARAMS,
        self::CONFIG_ROOT_CONNECTIVITY,
        self::CONFIG_ROOT_REMOTE_TIME,
        self::CONFIG_ROOT_MANAGE_RATE_LIMITS,
        self::CONFIG_ROOT_SECURE_PARAMS,
    ];

    const CONFIG_PARAMS_FIELDS = [
        'endpoint',
        'key',
        'secret',
        'passphrase',
    ];

    const CONFIG_CONNECTIVITY_FIELDS_MAPPING = [
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

    public static function createDefault(string $endpoint, string $key, string $secret, string $passphrase): self
    {
        return new static($endpoint, $key, $secret, $passphrase);
    }

    public static function createWithAllConnectivityDisabled(string $endpoint, string $key, string $secret, string $passphrase): self
    {
        $config = new static($endpoint, $key, $secret, $passphrase);

        $config->getConnectivityConfig()
            ->activateAccounts(false)
            ->activateOrders(false)
            ->activateFills(false)
            ->activateLimits(false)
            ->activateDeposits(false)
            ->activateWithdrawals(false)
            ->activateStablecoinConversions(false)
            ->activatePaymentMethods(false)
            ->activateCoinbaseAccounts(false)
            ->activateFees(false)
            ->activateReports(false)
            ->activateProfiles(false)
            ->activateUserAccount(false)
            ->activateMargin(false)
            ->activateOracle(false)
            ->activateProducts(false)
            ->activateCurrencies(false)
            ->activateTime(false)
        ;

        return $config;
    }

    public static function createFromYaml(string $pathToYamlConfig): self
    {
        $config = self::parseYamlConfigFile($pathToYamlConfig);
        self::checkConfig($config);

        $coinbaseConfig = self::createDefault(
            $config[self::CONFIG_ROOT_PARAMS][self::CONFIG_PARAMS_FIELDS[0]],
            $config[self::CONFIG_ROOT_PARAMS][self::CONFIG_PARAMS_FIELDS[1]],
            $config[self::CONFIG_ROOT_PARAMS][self::CONFIG_PARAMS_FIELDS[2]],
            $config[self::CONFIG_ROOT_PARAMS][self::CONFIG_PARAMS_FIELDS[3]]
        );

        if (isset($config[self::CONFIG_ROOT_REMOTE_TIME])) {
            $coinbaseConfig->setUseCoinbaseRemoteTime((bool) $config[self::CONFIG_ROOT_REMOTE_TIME]);
        }

        if (isset($config[self::CONFIG_ROOT_MANAGE_RATE_LIMITS])) {
            $coinbaseConfig->setManageRateLimits((bool) $config[self::CONFIG_ROOT_MANAGE_RATE_LIMITS]);
        }

        if (isset($config[self::CONFIG_ROOT_SECURE_PARAMS])) {
            $coinbaseConfig->setUseSecurityLayerForParams((bool) $config[self::CONFIG_ROOT_SECURE_PARAMS]);
        }

        self::configureConnectivity($config, $coinbaseConfig);

        return $coinbaseConfig;
    }

    /**
     * @codeCoverageIgnore
     */
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

        if (!isset($config[self::CONFIG_ROOT_PARAMS])
            || !is_array($config[self::CONFIG_ROOT_PARAMS])
        ) {
            throw new ApiError(sprintf('Config file must contain %s as a root key', self::CONFIG_ROOT_PARAMS));
        }

        foreach (self::CONFIG_PARAMS_FIELDS as $PARAMS_FIELD) {
            if (!isset($config[self::CONFIG_ROOT_PARAMS][$PARAMS_FIELD])) {
                throw new ApiError(sprintf('Config file must contain %s key in params root key', $PARAMS_FIELD));
            }
        }

        foreach ($config[self::CONFIG_ROOT_PARAMS] as $k => $v) {
            // @codeCoverageIgnoreStart
            if (!in_array($k, self::CONFIG_PARAMS_FIELDS)) {
                continue;
            }
            // @codeCoverageIgnoreEnd
            preg_match('#^\$\{(.+)\}$#', $v, $matches);
            if (isset($matches[1])) {
                $config[self::CONFIG_ROOT_PARAMS][$k] = getenv($matches[1]);
            }
        }
    }

    private static function configureConnectivity(array $config, AbstractConfig $apiConfig): void
    {
        if (!isset($config[self::CONFIG_ROOT_CONNECTIVITY]) || !is_array($config[self::CONFIG_ROOT_CONNECTIVITY])) {
            return;
        }

        foreach (self::CONFIG_CONNECTIVITY_FIELDS_MAPPING as $key => $methodPart) {
            if (!isset($config[self::CONFIG_ROOT_CONNECTIVITY][$key])) {
                continue;
            }

            if (false === $config[self::CONFIG_ROOT_CONNECTIVITY][$key]) {
                $apiConfig->getConnectivityConfig()->{'activate'.ucfirst($methodPart)}(false);
            }
        }
    }
}
