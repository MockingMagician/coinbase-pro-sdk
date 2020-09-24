<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional;

use GuzzleHttp\ClientInterface;
use MockingMagician\CoinbaseProSdk\Contracts\ApiParamsInterface;
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
     * @var bool
     */
    private $manageRateLimits;

    public function __construct(
        ClientInterface $client,
        ApiParamsInterface $apiParams,
        bool $manageRateLimits = true
    ) {
        $this->client = $client;
        $this->apiParams = $apiParams;
        $this->manageRateLimits = $manageRateLimits;
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
        ?PaginationInterface $pagination = null,
        bool $mustBeSigned = true
    ): RequestInterface {
        return new RequestWithErrorManagement(
            new Request(
                $this->client,
                $this->apiParams,
                $method,
                $routePath,
                $queryArgs,
                $body,
                $pagination,
                $mustBeSigned,
                $this->time
            ),
            $this->manageRateLimits
        );
    }
}
