<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use MockingMagician\CoinbaseProSdk\Contracts\ApiParamsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\RequestInterface;
use MockingMagician\CoinbaseProSdk\Functional\ApiParams;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TimeData;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use MockingMagician\CoinbaseProSdk\Functional\RequestFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @covers MockingMagician\CoinbaseProSdk\Functional\RequestFactory
 *
 * @internal
 */
class RequestFactoryTest extends TestCase
{
    public function testSome()
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
