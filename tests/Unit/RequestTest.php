<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiParamsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use MockingMagician\CoinbaseProSdk\Functional\Error\CurlErrorToManaged;
use MockingMagician\CoinbaseProSdk\Functional\Error\RateLimitsErrorToManaged;
use MockingMagician\CoinbaseProSdk\Functional\Error\TimestampExpiredErrorToManaged;
use MockingMagician\CoinbaseProSdk\Functional\Request\Request;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @covers MockingMagician\CoinbaseProSdk\Functional\Request\Request
 *
 * @internal
 */
class RequestTest extends TestCase
{
    const API_RETURN_VALID_JSON = '{"key": "value"}';
    const API_ERROR_MESSAGE = 'error message from remote api';
    const API_ERROR_MESSAGE_TIMESTAMP_EXPIRED = 'request timestamp expired';
    const API_RETURN_JSON_ERROR_MESSAGE = '{"message": "'.self::API_ERROR_MESSAGE.'"}';
    const API_RETURN_JSON_ERROR_MESSAGE_TIMESTAMP_EXPIRED = '{"message": "'.self::API_ERROR_MESSAGE_TIMESTAMP_EXPIRED.'"}';

    public function testPublicCallSuccess()
    {
        // Provide Prophecies. Not by dataProvider, cause prophecy would not be observed
        list(
            $client,
            $apiParams,
            $response,
            $stream,
            $badResponse,
            $pagination,
            $time
            ) = $this->providePropheciesForTests();

        // SCENARIO
        $stream->getContents()->willReturn(self::API_RETURN_VALID_JSON)->shouldBeCalledTimes(1);
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledTimes(1);
        $client->send(Argument::type(RequestInterface::class))->willReturn($response->reveal())->shouldBeCalledTimes(1);

        // PREPARE REQUEST
        $request = new Request($client->reveal(), $apiParams->reveal(), 'GET', '/public');
        $request->setMustBeSigned(false);

        // RUN
        self::assertEquals(self::API_RETURN_VALID_JSON, $request->send());
    }

    public function testPrivateCallSuccess()
    {
        // Provide Prophecies. Not by dataProvider, cause prophecy would not be observed
        list(
            $client,
            $apiParams,
            $response,
            $stream,
            $badResponse,
            $pagination,
            $time
            ) = $this->providePropheciesForTests();

        // SCENARIO
        $stream->getContents()->willReturn(self::API_RETURN_VALID_JSON)->shouldBeCalledTimes(1);
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledTimes(1);
        $client->send(Argument::type(RequestInterface::class))->willReturn($response->reveal())->shouldBeCalledTimes(1);

        // PREPARE REQUEST
        $this->setApiParamsForPrivate($apiParams);
        $request = new Request($client->reveal(), $apiParams->reveal(), 'GET', '/private');

        // RUN
        self::assertEquals(self::API_RETURN_VALID_JSON, $request->send());
    }

    public function testCallFailWithRemoteApiErrorMessage()
    {
        // Provide Prophecies. Not by dataProvider, cause prophecy would not be observed
        list(
            $client,
            $apiParams,
            $response,
            $stream,
            $badResponse,
            $pagination,
            $time
            ) = $this->providePropheciesForTests();

        // SCENARIO
        $stream->getContents()->willReturn(self::API_RETURN_JSON_ERROR_MESSAGE)->shouldBeCalledTimes(1);
        $response->getStatusCode()->willReturn(400)->shouldBeCalledTimes(1);
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledTimes(1);
        $badResponse->hasResponse()->willReturn(true)->shouldBeCalledTimes(1);
        $badResponse->getResponse()->willReturn($response->reveal())->shouldBeCalledTimes(2);
        $client->send(Argument::type(RequestInterface::class))->willThrow($badResponse->reveal())->shouldBeCalledTimes(1);

        // PREPARE REQUEST
        $request = new Request($client->reveal(), $apiParams->reveal(), 'GET', '/public');
        $request->setMustBeSigned(false);

        // RUN
        $this->expectException(ApiError::class);
        $this->expectExceptionMessage(self::API_ERROR_MESSAGE);
        $request->send();
    }

    public function testCallFailWithBadResponseButHasNoResponse()
    {
        // Provide Prophecies. Not by dataProvider, cause prophecy would not be observed
        list(
            $client,
            $apiParams,
            $response,
            $stream,
            $badResponse,
            $pagination,
            $time
            ) = $this->providePropheciesForTests();

        // SCENARIO
        $badResponse->hasResponse()->willReturn(false)->shouldBeCalledTimes(1);
        $client->send(Argument::type(RequestInterface::class))->willThrow($badResponse->reveal())->shouldBeCalledTimes(1);

        // PREPARE REQUEST
        $request = new Request($client->reveal(), $apiParams->reveal(), 'GET', '/public');
        $request->setMustBeSigned(false);

        // RUN
        $this->expectException(ApiError::class);
        $request->send();
    }

    public function testCallFailWithCode429ThrowRateLimitsErrorToManaged()
    {
        // Provide Prophecies. Not by dataProvider, cause prophecy would not be observed
        list(
            $client,
            $apiParams,
            $response,
            $stream,
            $badResponse,
            $pagination,
            $time
            ) = $this->providePropheciesForTests();

        // SCENARIO
        $response->getStatusCode()->willReturn(429)->shouldBeCalledTimes(1);
        $badResponse->hasResponse()->willReturn(true)->shouldBeCalledTimes(1);
        $badResponse->getResponse()->willReturn($response->reveal())->shouldBeCalledTimes(1);
        $client->send(Argument::type(RequestInterface::class))->willThrow($badResponse->reveal())->shouldBeCalledTimes(1);

        // PREPARE REQUEST
        $request = new Request($client->reveal(), $apiParams->reveal(), 'GET', '/public');
        $request->setMustBeSigned(false);

        // RUN
        $this->expectException(RateLimitsErrorToManaged::class);
        $request->send();
    }

    public function testCallFailWithRemoteApiErrorMessageTimestampExpiredThrowTimestampExpiredErrorToManaged()
    {
        // Provide Prophecies. Not by dataProvider, cause prophecy would not be observed
        list(
            $client,
            $apiParams,
            $response,
            $stream,
            $badResponse,
            $pagination,
            $time
            ) = $this->providePropheciesForTests();

        // SCENARIO
        $stream->getContents()->willReturn(self::API_RETURN_JSON_ERROR_MESSAGE_TIMESTAMP_EXPIRED)->shouldBeCalledTimes(1);
        $response->getStatusCode()->willReturn(400)->shouldBeCalledTimes(1);
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledTimes(1);
        $badResponse->hasResponse()->willReturn(true)->shouldBeCalledTimes(1);
        $badResponse->getResponse()->willReturn($response->reveal())->shouldBeCalledTimes(2);
        $client->send(Argument::type(RequestInterface::class))->willThrow($badResponse->reveal())->shouldBeCalledTimes(1);

        // PREPARE REQUEST
        $request = new Request($client->reveal(), $apiParams->reveal(), 'GET', '/public');
        $request->setMustBeSigned(false);

        // RUN
        $this->expectException(TimestampExpiredErrorToManaged::class);
        $request->send();
    }

    public function testCallFailWithSomeCurlErrorThrowCurlErrorToManaged()
    {
        // Provide Prophecies. Not by dataProvider, cause prophecy would not be observed
        list(
            $client,
            $apiParams,
            $response,
            $stream,
            $badResponse,
            $pagination,
            $time
            ) = $this->providePropheciesForTests();

        // SCENARIO
        $client
            ->send(Argument::type(RequestInterface::class))
            ->willThrow(new \Exception(Request::CURL_ERRORS_TO_MANAGE__REGEX[0]))
            ->shouldBeCalledTimes(1)
        ;

        // PREPARE REQUEST
        $request = new Request($client->reveal(), $apiParams->reveal(), 'GET', '/public');
        $request->setMustBeSigned(false);

        // RUN
        $this->expectException(CurlErrorToManaged::class);
        $request->send();
    }

    public function testCallFailWithSomeOtherError()
    {
        // Provide Prophecies. Not by dataProvider, cause prophecy would not be observed
        list(
            $client,
            $apiParams,
            $response,
            $stream,
            $badResponse,
            $pagination,
            $time
            ) = $this->providePropheciesForTests();

        // SCENARIO
        $client
            ->send(Argument::type(RequestInterface::class))
            ->willThrow(new \Exception('hi there'))
            ->shouldBeCalledTimes(1)
        ;

        // PREPARE REQUEST
        $request = new Request($client->reveal(), $apiParams->reveal(), 'GET', '/public');
        $request->setMustBeSigned(false);

        // RUN
        $this->expectExceptionMessage('hi there');
        $this->expectException(ApiError::class);
        $request->send();
    }

    public function testCallWithPagination()
    {
        // Provide Prophecies. Not by dataProvider, cause prophecy would not be observed
        list(
            $client,
            $apiParams,
            $response,
            $stream,
            $badResponse,
            $pagination,
            $time
            ) = $this->providePropheciesForTests();

        // SCENARIO
        $pagination->getQueryArgs()->willReturn(['some arg' => 'some value'])->shouldBeCalledTimes(1);
        $pagination->autoPaginateFromHeaders(Argument::is('some header value'), Argument::is('some header value'))->shouldBeCalledTimes(1);
        $stream->getContents()->willReturn(self::API_RETURN_VALID_JSON)->shouldBeCalledTimes(1);
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledTimes(1);
        $response->getHeader(Argument::any())->willReturn(['some header value'])->shouldBeCalledTimes(2);
        $client->send(Argument::type(RequestInterface::class))->willReturn($response->reveal())->shouldBeCalledTimes(1);

        // PREPARE REQUEST
        $request = new Request($client->reveal(), $apiParams->reveal(), 'GET', '/public', ['arg' => 'val'], null, $pagination->reveal());
        $request->setMustBeSigned(false);

        // RUN
        self::assertEquals(self::API_RETURN_VALID_JSON, $request->send());
    }

    public function testCallWithBadTimeReturnNotFail()
    {
        // Provide Prophecies. Not by dataProvider, cause prophecy would not be observed
        list(
            $client,
            $apiParams,
            $response,
            $stream,
            $badResponse,
            $pagination,
            $time
            ) = $this->providePropheciesForTests();

        // SCENARIO
        $stream->getContents()->willReturn(self::API_RETURN_VALID_JSON)->shouldBeCalledTimes(1);
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledTimes(1);
        $client->send(Argument::type(RequestInterface::class))->willReturn($response->reveal())->shouldBeCalledTimes(1);

        // PREPARE REQUEST
        $this->setApiParamsForPrivate($apiParams);
        $request = new Request(
            $client->reveal(),
            $apiParams->reveal(),
            'GET',
            '/private',
            [],
            false,
            null,
            true,
            $time->reveal()
        );

        // RUN
        $this->setApiParamsForPrivate($apiParams);
        self::assertEquals(self::API_RETURN_VALID_JSON, $request->send());
    }

    public function providePropheciesForTests()
    {
        $apiParams = $this->prophesize(ApiParamsInterface::class);
        $apiParams->getEndPoint()->willReturn('endpoint')->shouldBeCalledOnce();

        return [
            $this->prophesize(ClientInterface::class),
            $apiParams,
            $this->prophesize(ResponseInterface::class),
            $this->prophesize(StreamInterface::class),
            $this->prophesize(BadResponseException::class),
            $this->prophesize(PaginationInterface::class),
            $this->prophesize(TimeInterface::class),
        ];
    }

    private function setApiParamsForPrivate($apiParams)
    {
        $apiParams->getSecret()->willReturn('secret')->shouldBeCalledOnce();
        $apiParams->getKey()->willReturn('key')->shouldBeCalledOnce();
        $apiParams->getPassphrase()->willReturn('passphrase')->shouldBeCalledOnce();
    }
}
