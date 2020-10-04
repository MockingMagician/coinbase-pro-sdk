<?php


namespace MockingMagician\CoinbaseProSdk\Tests\Unit\Api;


use MockingMagician\CoinbaseProSdk\Functional\Api\CoinbaseApi;
use MockingMagician\CoinbaseProSdk\Functional\Api\Config\CoinbaseConfig;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\AbstractRequestFactoryAware;
use PHPUnit\Framework\TestCase;
use Throwable;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\Api\CoinbaseApi
 */
class CoinbaseApiTest extends TestCase
{
    public function testWithAllConnectivityEnabled()
    {
        $api = new CoinbaseApi(CoinbaseConfig::createDefault('', '', '', ''));

        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->accounts());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->orders());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->fills());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->limits());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->deposits());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->withdrawals());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->stablecoinConversions());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->paymentMethods());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->coinbaseAccounts());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->fees());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->reports());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->profiles());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->userAccount());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->margin());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->oracle());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->products());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->currencies());
        self::assertInstanceOf(AbstractRequestFactoryAware::class, $api->time());
    }

    public function testWithAllConnectivityDisabled()
    {
        $api = new CoinbaseApi(CoinbaseConfig::createWithAllConnectivityDisabled('', '', '', ''));

        $exception = null;

        try {
             $api->accounts();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->orders();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->fills();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->limits();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->deposits();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->withdrawals();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->stablecoinConversions();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->paymentMethods();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->coinbaseAccounts();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->fees();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->reports();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->profiles();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->userAccount();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->margin();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->oracle();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->products();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->currencies();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);

        $exception = null;

        try {
             $api->time();
        } catch (Throwable $exception) {
        }
        self::assertNotNull($exception);
    }
}
