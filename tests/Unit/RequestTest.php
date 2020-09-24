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
use MockingMagician\CoinbaseProSdk\Contracts\Build\GlobalRateLimitsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TimeData;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use MockingMagician\CoinbaseProSdk\Functional\RequestManager;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @cover Request|RequestManager
 */
class RequestTest extends TestCase
{
    private function providePropheciesForTest()
    {
        $apiParams = $this->prophesize(ApiParamsInterface::class);
        $apiParams->getEndPoint()->willReturn('endpoint')->shouldBeCalledOnce();

        return [
            $this->prophesize(StreamInterface::class),
            $this->prophesize(ResponseInterface::class),
            $this->prophesize(BadResponseException::class),
            $this->prophesize(ClientInterface::class),
            $apiParams,
        ];
    }

    private function setApiParamsForPrivate($apiParams)
    {
        $apiParams->getEndPoint()->willReturn('endpoint')->shouldBeCalledOnce();
        $apiParams->getSecret()->willReturn('secret')->shouldBeCalledOnce();
        $apiParams->getKey()->willReturn('key')->shouldBeCalledOnce();
        $apiParams->getPassphrase()->willReturn('passphrase')->shouldBeCalledOnce();
    }

    public function testPublicCallSuccess()
    {
        list($stream, $response, $badResponse, $client, $apiParams) = $this->providePropheciesForTest();

        // Scenario
        $stream->getContents()->willReturn('{"key": "value"}')->shouldBeCalledOnce();
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledOnce();
        $client->send(Argument::any())->willReturn($response->reveal())->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal()
        );
        $requestManager->prepareRequest('GET', '/route')->setMustBeSigned(false)->send();
    }

    public function testPrivateCallSuccess()
    {
        list($stream, $response, $badResponse, $client, $apiParams) = $this->providePropheciesForTest();
        $this->setApiParamsForPrivate($apiParams);

        // Scenario
        $stream->getContents()->willReturn('{"key": "value"}')->shouldBeCalledOnce();
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledOnce();
        $client->send(Argument::any())->willReturn($response->reveal())->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal()
        );
        $requestManager->prepareRequest('GET', '/route')->send();
    }

    public function testCallFailWithDistantApiError()
    {
        list($stream, $response, $badResponse, $client, $apiParams) = $this->providePropheciesForTest();
        $this->setApiParamsForPrivate($apiParams);

        // Scenario
        $stream->getContents()->willReturn('{"message": "error message returned by distant api"}')->shouldBeCalledOnce();
        $response->getStatusCode()->willReturn(400)->shouldBeCalledOnce();
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledOnce();
        $badResponse->hasResponse()->willreturn(true);
        $badResponse->getResponse()->willreturn($response->reveal());
        $client->send(Argument::any())->willThrow($badResponse->reveal())->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal()
        );

        $this->expectException(ApiError::class);
        $this->expectExceptionMessage('error message returned by distant api');

        $requestManager->prepareRequest('GET', '/route')->send();
    }

    public function testCallRetryWithRateLimitApiError()
    {
        list($stream, $response, $badResponse, $client, $apiParams) = $this->providePropheciesForTest();
        $apiParams->getEndPoint()->willReturn('endpoint')->shouldBeCalledTimes(2);
        $apiParams->getSecret()->willReturn('secret')->shouldBeCalledTimes(2);
        $apiParams->getKey()->willReturn('key')->shouldBeCalledTimes(2);
        $apiParams->getPassphrase()->willReturn('passphrase')->shouldBeCalledTimes(2);

        // Scenario
        $stream->getContents()->willReturn('{"message": "error message returned by distant api"}')->shouldBeCalledTimes(1);
        $response->getStatusCode()->willReturn(429)->shouldBeCalledTimes(1);
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledTimes(1);
        $badResponse->hasResponse()->willreturn(true);
        $badResponse->getResponse()->willreturn($response->reveal());
        $badResponse = $badResponse->reveal();
        $generator = function () use ($badResponse, $response) {
            for ($i = 0; $i < 2; $i++) {
                if ($i === 0) {
                    yield $badResponse;
                }

                yield $response;
            }
        };
        $generator = $generator();
        $client->send(Argument::any())->will(function () use ($generator) {
            $value = $generator->current();
            $generator->next();
            if ($value instanceof BadResponseException) {
                throw $value;
            }

            return $value;
        })->shouldBeCalledTimes(2);

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal()
        );

        $requestManager->prepareRequest('GET', '/route')->send();
    }

    public function testCallFailWithOtherError()
    {
        list($stream, $response, $badResponse, $client, $apiParams) = $this->providePropheciesForTest();
        $this->setApiParamsForPrivate($apiParams);

        // Scenario
        $client->send(Argument::any())->willThrow(new \Exception('Exception from elsewhere'))->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal()
        );

        $this->expectException(ApiError::class);
        $this->expectExceptionMessage('Exception from elsewhere');

        $requestManager->prepareRequest('GET', '/route')->send();
    }

    public function testCallWithPagination()
    {
        list($stream, $response, $badResponse, $client, $apiParams) = $this->providePropheciesForTest();
        $this->setApiParamsForPrivate($apiParams);
        $pagination = $this->prophesize(PaginationInterface::class);

        // Scenario

        $pagination->getQueryArgs()->willReturn([]);
        $pagination->autoPaginateFromHeaders(Argument::any(), Argument::any());
        $stream->getContents()->willReturn('{"key": "value"}')->shouldBeCalledOnce();
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledOnce();
        $response->getHeader(Argument::any())->willReturn(['header'])->shouldBeCalledTimes(2);
        $client->send(Argument::any())->willReturn($response->reveal())->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal()
        );
        $requestManager->prepareRequest('GET', '/route', ['key' => 'value'], null, $pagination->reveal())->send();
    }

    public function testCallWithTimeInterfaceReturnedValidTimeData()
    {
        list($stream, $response, $badResponse, $client, $apiParams) = $this->providePropheciesForTest();
        $this->setApiParamsForPrivate($apiParams);
        $time = $this->prophesize(TimeInterface::class);

        // Scenario
        $time->getTime()->willReturn(new TimeData(json_encode(['iso' => 'some-iso-date', 'epoch' => time()])));
        $stream->getContents()->willReturn('{"key": "value"}')->shouldBeCalledOnce();
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledOnce();
        $client->send(Argument::any())->willReturn($response->reveal())->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal()
        );
        $requestManager->setTimeInterface($time->reveal());

        $requestManager->prepareRequest('GET', '/route')->send();
    }

    public function testCallWithTimeInterfaceReturnedInvalidTimeData()
    {
        list($stream, $response, $badResponse, $client, $apiParams) = $this->providePropheciesForTest();
        $this->setApiParamsForPrivate($apiParams);
        $time = $this->prophesize(TimeInterface::class);

        // Scenario
        $time->getTime()->willThrow(new \Exception());
        $stream->getContents()->willReturn('{"key": "value"}')->shouldBeCalledOnce();
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledOnce();
        $client->send(Argument::any())->willReturn($response->reveal())->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal()
        );
        $requestManager->setTimeInterface($time->reveal());

        $requestManager->prepareRequest('GET', '/route')->send();
    }
}
