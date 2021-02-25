<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\Api\Config;

use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ConfigInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ConnectivityConfigInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestFactoryInterface;
use MockingMagician\CoinbaseProSdk\Functional\Api\Config\CoinbaseConfig;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\Api\Config\AbstractConfig
 * @covers \MockingMagician\CoinbaseProSdk\Functional\Api\Config\CoinbaseConfig
 * @covers \MockingMagician\CoinbaseProSdk\Functional\Api\Config\ConnectivityConfig
 *
 * @internal
 */
class CoinbaseConfigTest extends TestCase
{
    public function testCreateFromYamlWithFull()
    {
        $_ENV['API_ENDPOINT'] = 'API_ENDPOINT';
        $_ENV['API_KEY'] = 'API_KEY';
        $_ENV['API_SECRET'] = 'API_SECRET';
        $_ENV['API_PASSPHRASE'] = 'API_PASSPHRASE';

        $coinbaseConfig = CoinbaseConfig::createFromYaml(__DIR__.'/yaml_config/full.yaml'); // Full with all

        self::assertInstanceOf(ConfigInterface::class, $coinbaseConfig);

        self::assertTrue($coinbaseConfig->isUseCoinbaseRemoteTime());
        self::assertFalse($coinbaseConfig->isManageRateLimits());
        self::assertFalse($coinbaseConfig->isUseSecurityLayerForParams());

        self::assertInstanceOf(ConnectivityConfigInterface::class, $coinbaseConfig->getConnectivityConfig());
        self::assertInstanceOf(RequestFactoryInterface::class, $coinbaseConfig->getBuildRequestFactory());
    }

    public function testCreateFromYamlConfigWithMinimal()
    {
        $_ENV['API_ENDPOINT'] = 'API_ENDPOINT';
        $_ENV['API_KEY'] = 'API_KEY';
        $_ENV['API_SECRET'] = 'API_SECRET';
        $_ENV['API_PASSPHRASE'] = 'API_PASSPHRASE';

        $coinbaseConfig = CoinbaseConfig::createFromYaml(__DIR__.'/yaml_config/minimal.yaml'); // Minimal only params

        self::assertInstanceOf(ConfigInterface::class, $coinbaseConfig);

        self::assertFalse($coinbaseConfig->isUseCoinbaseRemoteTime());
        self::assertTrue($coinbaseConfig->isManageRateLimits());
        self::assertTrue($coinbaseConfig->isUseSecurityLayerForParams());

        self::assertInstanceOf(ConnectivityConfigInterface::class, $coinbaseConfig->getConnectivityConfig());
        self::assertInstanceOf(RequestFactoryInterface::class, $coinbaseConfig->getBuildRequestFactory());
    }

    public function testCreateFromYamlFailIfParamsIsMissing()
    {
        $this->expectException(ApiError::class);
        $this->expectExceptionMessage('Config file must contain params as a root key');
        CoinbaseConfig::createFromYaml(__DIR__.'/yaml_config/missing_params.yaml');
    }

    public function testCreateFromYamlFailIfOneOfParamsIsMissing()
    {
        $this->expectException(ApiError::class);
        $this->expectExceptionMessage('Config file must contain endpoint key in params root key');
        CoinbaseConfig::createFromYaml(__DIR__.'/yaml_config/one_missing_params.yaml');
    }

    public function testCreateFromYamlWithSomeOfConnectivityDisabled()
    {
        $_ENV['API_ENDPOINT'] = 'API_ENDPOINT';
        $_ENV['API_KEY'] = 'API_KEY';
        $_ENV['API_SECRET'] = 'API_SECRET';
        $_ENV['API_PASSPHRASE'] = 'API_PASSPHRASE';

        $coinbaseConfig = CoinbaseConfig::createFromYaml(__DIR__.'/yaml_config/some_of_connectivity_disabled.yaml');

        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isAccountsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isOrdersActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isFillsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isLimitsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isDepositsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isWithdrawalsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isStablecoinConversionsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isPaymentMethodsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isCoinbaseAccountsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isFeesActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isReportsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isProfilesActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isMarginActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isOracleActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isProductsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isCurrenciesActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isTimeActivate());
    }

    public function testCreateDefault()
    {
        $coinbaseConfig = CoinbaseConfig::createDefault('', '', '', '');

        self::assertInstanceOf(ConfigInterface::class, $coinbaseConfig);

        self::assertFalse($coinbaseConfig->isUseCoinbaseRemoteTime());
        self::assertTrue($coinbaseConfig->isManageRateLimits());
        self::assertTrue($coinbaseConfig->isUseSecurityLayerForParams());

        self::assertInstanceOf(ConnectivityConfigInterface::class, $coinbaseConfig->getConnectivityConfig());
        self::assertInstanceOf(RequestFactoryInterface::class, $coinbaseConfig->getBuildRequestFactory());
    }

    public function testCreateCustom()
    {
        $coinbaseConfig = CoinbaseConfig::createDefault('', '', '', '');

        self::assertInstanceOf(ConnectivityConfigInterface::class, $coinbaseConfig->getConnectivityConfig());
        self::assertInstanceOf(RequestFactoryInterface::class, $coinbaseConfig->getBuildRequestFactory());

        self::assertFalse($coinbaseConfig->isUseCoinbaseRemoteTime());
        self::assertTrue($coinbaseConfig->isManageRateLimits());
        self::assertTrue($coinbaseConfig->isUseSecurityLayerForParams());

        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isAccountsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isOrdersActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isFillsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isLimitsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isDepositsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isWithdrawalsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isStablecoinConversionsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isPaymentMethodsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isCoinbaseAccountsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isFeesActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isReportsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isProfilesActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isMarginActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isOracleActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isProductsActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isCurrenciesActivate());
        self::assertTrue($coinbaseConfig->getConnectivityConfig()->isTimeActivate());

        $coinbaseConfig->getConnectivityConfig()
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
            ->activateMargin(false)
            ->activateOracle(false)
            ->activateProducts(false)
            ->activateCurrencies(false)
            ->activateTime(false)
        ;

        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isAccountsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isOrdersActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isFillsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isLimitsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isDepositsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isWithdrawalsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isStablecoinConversionsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isPaymentMethodsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isCoinbaseAccountsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isFeesActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isReportsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isProfilesActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isMarginActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isOracleActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isProductsActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isCurrenciesActivate());
        self::assertFalse($coinbaseConfig->getConnectivityConfig()->isTimeActivate());
    }
}
