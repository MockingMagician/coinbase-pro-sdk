<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\Api;

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Functional\Api\ApiConfig;
use MockingMagician\CoinbaseProSdk\Functional\Api\ApiFactory;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\AbstractRequestManagerAware;
use PHPUnit\Framework\TestCase;

/**
 * @covers MockingMagician\CoinbaseProSdk\Functional\Api\ApiFactory
 *
 * @internal
 */
class ApiFactoryTest extends TestCase
{
    public function testCreateFromYamlConfigWithFull()
    {
        $_ENV['API_ENDPOINT'] = 'API_ENDPOINT';
        $_ENV['API_KEY'] = 'API_KEY';
        $_ENV['API_SECRET'] = 'API_SECRET';
        $_ENV['API_PASSPHRASE'] = 'API_PASSPHRASE';

        $api = ApiFactory::createFromYamlConfig(__DIR__ . '/configs/api_config_full.yaml'); // Full with all

        self::assertInstanceOf(ApiInterface::class, $api);

        $apiReflect = new \ReflectionClass(ApiInterface::class);

        foreach ($apiReflect->getMethods() as $method) {
            self::assertInstanceOf(AbstractRequestManagerAware::class, $api->{$method->getName()}());
        }
    }

    public function testCreateFromYamlConfigWithMinimal()
    {
        $_ENV['API_ENDPOINT'] = 'API_ENDPOINT';
        $_ENV['API_KEY'] = 'API_KEY';
        $_ENV['API_SECRET'] = 'API_SECRET';
        $_ENV['API_PASSPHRASE'] = 'API_PASSPHRASE';

        $api = ApiFactory::createFromYamlConfig(__DIR__ . '/configs/api_config_minimal.yaml'); // Minimal

        $apiReflect = new \ReflectionClass(ApiInterface::class);

        foreach ($apiReflect->getMethods() as $method) {
            self::assertInstanceOf(AbstractRequestManagerAware::class, $api->{$method->getName()}());
        }
    }

    public function testCreateNative()
    {
        $api = ApiFactory::create('', '', '', '');

        $apiReflect = new \ReflectionClass(ApiInterface::class);

        foreach ($apiReflect->getMethods() as $method) {
            self::assertInstanceOf(AbstractRequestManagerAware::class, $api->{$method->getName()}());
        }
    }

    public function testCreateCustom()
    {
        $apiConfig = new ApiConfig();

        $apiConfig->connectivityConfig()
            ->setPaymentMethods(false)
            ->setProducts(false)
            ->setProfiles(false)
            ->setReports(false)
            ->setStablecoinConversions(false)
            ->setTime(false)
            ->setUserAccount(false)
            ->setWithdrawals(false)
        ;

        $api = ApiFactory::create(
            '',
            '',
            '',
            '',
            $apiConfig
        );

        self::assertInstanceOf(AbstractRequestManagerAware::class, $api->accounts());
        self::assertInstanceOf(AbstractRequestManagerAware::class, $api->coinbaseAccounts());
        self::assertInstanceOf(AbstractRequestManagerAware::class, $api->currencies());
        self::assertInstanceOf(AbstractRequestManagerAware::class, $api->deposits());
        self::assertInstanceOf(AbstractRequestManagerAware::class, $api->fees());
        self::assertInstanceOf(AbstractRequestManagerAware::class, $api->fills());
        self::assertInstanceOf(AbstractRequestManagerAware::class, $api->limits());
        self::assertInstanceOf(AbstractRequestManagerAware::class, $api->margin());
        self::assertInstanceOf(AbstractRequestManagerAware::class, $api->oracle());

        $exception = null;

        try {
            self::assertInstanceOf(AbstractRequestManagerAware::class, $api->paymentMethods());
        } catch (\Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
            self::assertInstanceOf(AbstractRequestManagerAware::class, $api->products());
        } catch (\Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
            self::assertInstanceOf(AbstractRequestManagerAware::class, $api->profiles());
        } catch (\Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
            self::assertInstanceOf(AbstractRequestManagerAware::class, $api->reports());
        } catch (\Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
            self::assertInstanceOf(AbstractRequestManagerAware::class, $api->stablecoinConversions());
        } catch (\Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
            self::assertInstanceOf(AbstractRequestManagerAware::class, $api->time());
        } catch (\Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
            self::assertInstanceOf(AbstractRequestManagerAware::class, $api->userAccount());
        } catch (\Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
            self::assertInstanceOf(AbstractRequestManagerAware::class, $api->withdrawals());
        } catch (\Throwable $exception) {
        }
        self::assertNotNull($exception);
    }
}
