<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional;

use GuzzleHttp\ClientInterface;
use MockingMagician\CoinbaseProSdk\Contracts\ApiParamsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\GlobalRateLimitsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
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
     * @var null|TimeInterface
     */
    private $time;
    /**
     * @var GlobalRateLimitsInterface
     */
    private $globalRateLimits;

    public function __construct(
        ClientInterface $client,
        ApiParamsInterface $apiParams,
        GlobalRateLimitsInterface $globalRateLimits
    ) {
        $this->client = $client;
        $this->apiParams = $apiParams;
        $this->globalRateLimits = $globalRateLimits;
    }

    public function setTimeInterface(TimeInterface $time)
    {
        $this->time = $time;
    }

    public function prepareRequest(
        string $method,
        string $routePath,
        array $queryArgs = [],
        ?string $body = null,
        ?PaginationInterface $pagination = null
    ): RequestInterface {
        return new Request(
            $this->client,
            $this->apiParams,
            $this->globalRateLimits,
            $method,
            $routePath,
            $queryArgs,
            $body,
            $pagination,
            $this->time
        );
    }
}
