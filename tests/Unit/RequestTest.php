<?php

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

class RequestTest extends TestCase
{
    public function testPublicCallSuccess()
    {
        // Scenario
        $stream = $this->prophesize(StreamInterface::class);
        $response = $this->prophesize(ResponseInterface::class);
        $client = $this->prophesize(ClientInterface::class);
        $apiParams = $this->prophesize(ApiParamsInterface::class);
        $globalRateLimits = $this->prophesize(GlobalRateLimitsInterface::class);

        $stream->getContents()->willReturn('{"key": "value"}')->shouldBeCalledOnce();
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledOnce();
        $client->send(Argument::any())->willReturn($response->reveal())->shouldBeCalledOnce();
        $globalRateLimits->recordPublicCallRequest()->shouldBeCalledOnce();
        $globalRateLimits->shouldWeWaitForPublicCallRequest()->willReturn(true, false)->shouldBeCalledTimes(2);
        $globalRateLimits->recordPrivateCallRequest()->shouldNotBeCalled();
        $globalRateLimits->shouldWeWaitForPrivateCallRequest()->shouldNotBeCalled();
        $apiParams->getEndPoint()->willReturn('endpoint')->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal(),
            $globalRateLimits->reveal()
        );
        $requestManager->prepareRequest('GET', '/route')->send();
    }

    public function testPrivateCallSuccess()
    {
        // Scenario
        $stream = $this->prophesize(StreamInterface::class);
        $response = $this->prophesize(ResponseInterface::class);
        $client = $this->prophesize(ClientInterface::class);
        $apiParams = $this->prophesize(ApiParamsInterface::class);
        $globalRateLimits = $this->prophesize(GlobalRateLimitsInterface::class);

        $stream->getContents()->willReturn('{"key": "value"}')->shouldBeCalledOnce();
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledOnce();
        $client->send(Argument::any())->willReturn($response->reveal())->shouldBeCalledOnce();
        $globalRateLimits->recordPrivateCallRequest()->shouldBeCalledOnce();
        $globalRateLimits->shouldWeWaitForPrivateCallRequest()->willReturn(true, false)->shouldBeCalledTimes(2);
        $globalRateLimits->recordPublicCallRequest()->shouldNotBeCalled();
        $globalRateLimits->shouldWeWaitForPublicCallRequest()->shouldNotBeCalled();
        $apiParams->getEndPoint()->willReturn('endpoint')->shouldBeCalledOnce();
        $apiParams->getSecret()->willReturn('secret')->shouldBeCalledOnce();
        $apiParams->getKey()->willReturn('key')->shouldBeCalledOnce();
        $apiParams->getPassphrase()->willReturn('passphrase')->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal(),
            $globalRateLimits->reveal()
        );
        $requestManager->prepareRequest('GET', '/route')->signAndSend();
    }

    public function testCallFailWithDistantApiError()
    {
        // Scenario
        $stream = $this->prophesize(StreamInterface::class);
        $response = $this->prophesize(ResponseInterface::class);
        $badResponse = $this->prophesize(BadResponseException::class);
        $client = $this->prophesize(ClientInterface::class);
        $apiParams = $this->prophesize(ApiParamsInterface::class);
        $globalRateLimits = $this->prophesize(GlobalRateLimitsInterface::class);

        $stream->getContents()->willReturn('{"message": "error message returned by distant api"}')->shouldBeCalledOnce();
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledOnce();
        $badResponse->hasResponse()->willreturn(true);
        $badResponse->getResponse()->willreturn($response->reveal());
        $client->send(Argument::any())->willThrow($badResponse->reveal())->shouldBeCalledOnce();
        $globalRateLimits->recordPublicCallRequest()->shouldBeCalledOnce();
        $globalRateLimits->shouldWeWaitForPublicCallRequest()->willReturn(false)->shouldBeCalledOnce();
        $apiParams->getEndPoint()->willReturn('endpoint')->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal(),
            $globalRateLimits->reveal()
        );

        $this->expectException(ApiError::class);
        $this->expectExceptionMessage('error message returned by distant api');

        $requestManager->prepareRequest('GET', '/route')->send();
    }

    public function testCallFailWithOtherError()
    {
        // Scenario
        $badResponse = $this->prophesize(BadResponseException::class);
        $client = $this->prophesize(ClientInterface::class);
        $apiParams = $this->prophesize(ApiParamsInterface::class);
        $globalRateLimits = $this->prophesize(GlobalRateLimitsInterface::class);

        $client->send(Argument::any())->willThrow(new \Exception('Exception from elsewhere'))->shouldBeCalledOnce();
        $globalRateLimits->recordPublicCallRequest()->shouldBeCalledOnce();
        $globalRateLimits->shouldWeWaitForPublicCallRequest()->willReturn(false)->shouldBeCalledOnce();
        $apiParams->getEndPoint()->willReturn('endpoint')->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal(),
            $globalRateLimits->reveal()
        );

        $this->expectException(ApiError::class);
        $this->expectExceptionMessage('Exception from elsewhere');

        $requestManager->prepareRequest('GET', '/route')->send();
    }

    public function testCallWithPagination()
    {
        // Scenario
        $stream = $this->prophesize(StreamInterface::class);
        $response = $this->prophesize(ResponseInterface::class);
        $client = $this->prophesize(ClientInterface::class);
        $apiParams = $this->prophesize(ApiParamsInterface::class);
        $globalRateLimits = $this->prophesize(GlobalRateLimitsInterface::class);
        $pagination = $this->prophesize(PaginationInterface::class);

        $pagination->getQueryArgs()->willReturn([]);
        $pagination->autoPaginateFromHeaders(Argument::any(), Argument::any());
        $stream->getContents()->willReturn('{"key": "value"}')->shouldBeCalledOnce();
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledOnce();
        $response->getHeader(Argument::any())->willReturn(['header'])->shouldBeCalledTimes(2);
        $client->send(Argument::any())->willReturn($response->reveal())->shouldBeCalledOnce();
        $globalRateLimits->recordPublicCallRequest()->shouldBeCalledOnce();
        $globalRateLimits->shouldWeWaitForPublicCallRequest()->willReturn(true, false)->shouldBeCalledTimes(2);
        $globalRateLimits->recordPrivateCallRequest()->shouldNotBeCalled();
        $globalRateLimits->shouldWeWaitForPrivateCallRequest()->shouldNotBeCalled();
        $apiParams->getEndPoint()->willReturn('endpoint')->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal(),
            $globalRateLimits->reveal()
        );
        $requestManager->prepareRequest('GET', '/route', ['key' => 'value'], null, $pagination->reveal())->send();
    }

    public function testCallWithTimeInterfaceReturnedValidTimeData()
    {
        // Scenario
        $time = $this->prophesize(TimeInterface::class);
        $time->getTime()->willReturn(new TimeData(json_encode(['iso' => 'some-iso-date', 'epoch' => time()])));
        $stream = $this->prophesize(StreamInterface::class);
        $response = $this->prophesize(ResponseInterface::class);
        $client = $this->prophesize(ClientInterface::class);
        $apiParams = $this->prophesize(ApiParamsInterface::class);
        $globalRateLimits = $this->prophesize(GlobalRateLimitsInterface::class);

        $stream->getContents()->willReturn('{"key": "value"}')->shouldBeCalledOnce();
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledOnce();
        $client->send(Argument::any())->willReturn($response->reveal())->shouldBeCalledOnce();
        $globalRateLimits->recordPrivateCallRequest()->shouldBeCalledOnce();
        $globalRateLimits->shouldWeWaitForPrivateCallRequest()->willReturn(true, false)->shouldBeCalledTimes(2);
        $globalRateLimits->recordPublicCallRequest()->shouldNotBeCalled();
        $globalRateLimits->shouldWeWaitForPublicCallRequest()->shouldNotBeCalled();
        $apiParams->getEndPoint()->willReturn('endpoint')->shouldBeCalledOnce();
        $apiParams->getSecret()->willReturn('secret')->shouldBeCalledOnce();
        $apiParams->getKey()->willReturn('key')->shouldBeCalledOnce();
        $apiParams->getPassphrase()->willReturn('passphrase')->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal(),
            $globalRateLimits->reveal()
        );
        $requestManager->setTimeInterface($time->reveal());

        $requestManager->prepareRequest('GET', '/route')->signAndSend();
    }

    public function testCallWithTimeInterfaceReturnedInvalidTimeData()
    {
        // Scenario
        $time = $this->prophesize(TimeInterface::class);
        $time->getTime()->willThrow(new \Exception());
        $stream = $this->prophesize(StreamInterface::class);
        $response = $this->prophesize(ResponseInterface::class);
        $client = $this->prophesize(ClientInterface::class);
        $apiParams = $this->prophesize(ApiParamsInterface::class);
        $globalRateLimits = $this->prophesize(GlobalRateLimitsInterface::class);

        $stream->getContents()->willReturn('{"key": "value"}')->shouldBeCalledOnce();
        $response->getBody()->willReturn($stream->reveal())->shouldBeCalledOnce();
        $client->send(Argument::any())->willReturn($response->reveal())->shouldBeCalledOnce();
        $globalRateLimits->recordPrivateCallRequest()->shouldBeCalledOnce();
        $globalRateLimits->shouldWeWaitForPrivateCallRequest()->willReturn(true, false)->shouldBeCalledTimes(2);
        $globalRateLimits->recordPublicCallRequest()->shouldNotBeCalled();
        $globalRateLimits->shouldWeWaitForPublicCallRequest()->shouldNotBeCalled();
        $apiParams->getEndPoint()->willReturn('endpoint')->shouldBeCalledOnce();
        $apiParams->getSecret()->willReturn('secret')->shouldBeCalledOnce();
        $apiParams->getKey()->willReturn('key')->shouldBeCalledOnce();
        $apiParams->getPassphrase()->willReturn('passphrase')->shouldBeCalledOnce();

        // Run
        $requestManager = new RequestManager(
            $client->reveal(),
            $apiParams->reveal(),
            $globalRateLimits->reveal()
        );
        $requestManager->setTimeInterface($time->reveal());

        $requestManager->prepareRequest('GET', '/route')->signAndSend();
    }
}
