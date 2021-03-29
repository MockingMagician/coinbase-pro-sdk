<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\Websocket;

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestFactoryInterface;
use MockingMagician\CoinbaseProSdk\Functional\Api\Config\Params;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TimeData;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\SubscriberAuthenticated;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class SubscriberTest extends TestCase
{
    /**
     * @var SubscriberAuthenticated
     */
    private $subscriber;

    public function setUp()
    {
        parent::setUp();
        $api = $this->createMock(ApiInterface::class);
        $requestFactory = $this->createMock(RequestFactoryInterface::class);
        $requestFactory->method('getParams')->willReturn(new Params('', 'key', 'secret', 'passphrase'));
        $api->method('getRequestFactory')->willReturn($requestFactory);
        $time = $this->createMock(TimeInterface::class);
        $now = new \DateTime();
        $time->method('getTime')->willReturn(new TimeData($now->format('c'), $now->getTimestamp()));
        $this->subscriber = new SubscriberAuthenticated($api, $time);
    }

    public function testSubscribe()
    {
        $payload = $this->subscriber->getPayload();
        $this->assertSame('subscribe', $payload['type']);
    }

    public function testUnsubscribe()
    {
        $payload = $this->subscriber->getPayload(true);
        $this->assertSame('unsubscribe', $payload['type']);
    }

    public function testNoChannel()
    {
        $payload = $this->subscriber->getPayload();
        $this->assertEmpty($payload['channels']);
    }

    public function testGeneralProductIds()
    {
        $this->subscriber->setProductIds(['BTC-EUR', 'BTC-USD']);
        $payload = $this->subscriber->getPayload();
        $this->assertSame(['BTC-EUR', 'BTC-USD'], $payload['product_ids']);
    }

    public function testChannelFull()
    {
        $this->abstractTestChannel('full', 'activateChannelFull');
    }

    public function testChannelHeartbeat()
    {
        $this->abstractTestChannel('heartbeat', 'activateChannelHeartbeat');
    }

    public function testChannelTicker()
    {
        $this->abstractTestChannel('ticker', 'activateChannelTicker');
    }

    public function testChannelLevel2()
    {
        $this->abstractTestChannel('level2', 'activateChannelLevel2');
    }

    public function testChannelMatches()
    {
        $this->abstractTestChannel('matches', 'activateChannelMatches');
    }

    public function testChannelUser()
    {
        $this->abstractTestChannel('user', 'activateChannelUser');
    }

    public function testChannelStatus()
    {
        $this->abstractTestChannel('status', 'activateChannelStatus', null);
    }

    private function abstractTestChannel(string $name, string $method, ?array $productIds = ['BTC-EUR', 'BTC-USD'])
    {
        if (!empty($productIds)) {
            $this->subscriber->{$method}(true, $productIds);
            $payload = $this->subscriber->getPayload();
            $this->assertSame([['name' => $name, 'product_ids' => $productIds]], $payload['channels']);
        }

        $this->subscriber->{$method}(true);
        $payload = $this->subscriber->getPayload();
        $this->assertSame([['name' => $name]], $payload['channels']);

        $this->subscriber->{$method}(false);
        $payload = $this->subscriber->getPayload();
        $this->assertEmpty($payload['channels']);
    }
}
