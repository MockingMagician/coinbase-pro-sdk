<?php


namespace MockingMagician\CoinbaseProSdk\Functional;


use GuzzleHttp\ClientInterface;
use MockingMagician\CoinbaseProSdk\Contracts\ApiParamsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\ConnectivityInterface;
use MockingMagician\CoinbaseProSdk\Contracts\RequestInterface;
use MockingMagician\CoinbaseProSdk\Contracts\RequestManagerInterface;

class RequestManager implements RequestManagerInterface
{
    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var ApiParamsInterface
     */
    private $apiParams;
    /**
     * @var TimeInterface|null
     */
    private $time;

    public function __construct(ClientInterface $client, ApiParamsInterface $apiParams)
    {
        $this->client = $client;
        $this->apiParams = $apiParams;
    }

    public function setTimeInterface(TimeInterface $time) {
        $this->time = $time;
    }

    public function prepareRequest(string $method, string $routePath, ?string $body = null): RequestInterface
    {
        return new Request($method, $routePath, $body, $this->client, $this->apiParams, $this->time);
    }
}
