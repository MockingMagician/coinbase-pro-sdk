<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\Api;

use MockingMagician\CoinbaseProSdk\CoinbaseFacade;
use MockingMagician\CoinbaseProSdk\Functional\Api\CoinbaseApi;
use MockingMagician\CoinbaseProSdk\Functional\Api\Config\CoinbaseConfig;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\AbstractConnectivity;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Subscriber;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\SubscriberAuthenticated;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Websocket;
use PHPUnit\Framework\TestCase;
use Throwable;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\Api\CoinbaseApi
 *
 * @internal
 */
class CoinbaseApiTest extends TestCase
{
    public function testWithAllConnectivityEnabled()
    {
        $api = new CoinbaseApi(CoinbaseConfig::createDefault('', '', '', ''));

        self::assertInstanceOf(AbstractConnectivity::class, $api->accounts());
        self::assertInstanceOf(AbstractConnectivity::class, $api->orders());
        self::assertInstanceOf(AbstractConnectivity::class, $api->fills());
        self::assertInstanceOf(AbstractConnectivity::class, $api->limits());
        self::assertInstanceOf(AbstractConnectivity::class, $api->deposits());
        self::assertInstanceOf(AbstractConnectivity::class, $api->withdrawals());
        self::assertInstanceOf(AbstractConnectivity::class, $api->stablecoinConversions());
        self::assertInstanceOf(AbstractConnectivity::class, $api->paymentMethods());
        self::assertInstanceOf(AbstractConnectivity::class, $api->coinbaseAccounts());
        self::assertInstanceOf(AbstractConnectivity::class, $api->fees());
        self::assertInstanceOf(AbstractConnectivity::class, $api->reports());
        self::assertInstanceOf(AbstractConnectivity::class, $api->profiles());
        self::assertInstanceOf(AbstractConnectivity::class, $api->margin());
        self::assertInstanceOf(AbstractConnectivity::class, $api->oracle());
        self::assertInstanceOf(AbstractConnectivity::class, $api->products());
        self::assertInstanceOf(AbstractConnectivity::class, $api->currencies());
        self::assertInstanceOf(AbstractConnectivity::class, $api->time());

        self::assertInstanceOf(Websocket::class, $api->websocket());
        self::assertInstanceOf(SubscriberAuthenticated::class, $api->websocket()->newSubscriber());

        self::assertInstanceOf(Subscriber::class, CoinbaseFacade::createUnauthenticatedWebsocket()->newSubscriber());
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
