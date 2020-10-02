<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\Request;

use GuzzleHttp\ClientInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestInterface;
use MockingMagician\CoinbaseProSdk\Functional\Api\ApiParams;
use MockingMagician\CoinbaseProSdk\Functional\Request\RequestFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\Request\RequestFactory
 *
 * @internal
 */
class RequestFactoryTest extends TestCase
{
    public function testCreateARequest()
    {
        $client = $this->prophesize(ClientInterface::class);
        $apiParams = $this->prophesize(ApiParams::class);

        $requestFactory = new RequestFactory(
            $client->reveal(),
            $apiParams->reveal()
        );

        $time = $this->prophesize(TimeInterface::class);

        $requestFactory->setTimeInterface($time->reveal());

        self::assertInstanceOf(RequestInterface::class, $requestFactory->createRequest('GET', '/route'));
    }
}
