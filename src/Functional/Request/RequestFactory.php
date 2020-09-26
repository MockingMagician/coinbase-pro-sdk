<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Request;

use GuzzleHttp\ClientInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiParamsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestFactoryInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestInspectorAwareInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestInspectorInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestInterface;

class RequestFactory implements RequestFactoryInterface, RequestInspectorAwareInterface
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
    /**
     * @var null|RequestInspectorInterface
     */
    private $requestInspector;

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

    public function createRequest(
        string $method,
        string $routePath,
        array $queryArgs = [],
        ?string $body = null,
        ?PaginationInterface $pagination = null,
        bool $mustBeSigned = true
    ): RequestInterface {
        $request = new Request(
            $this->client,
            $this->apiParams,
            $method,
            $routePath,
            $queryArgs,
            $body,
            $pagination,
            $mustBeSigned,
            $this->time
        );

        if ($this->requestInspector) {
            $request->inviteInspector($this->requestInspector);
        }

        return new RequestWithErrorManagement(
            $request,
            $this->manageRateLimits
        );
    }

    public function inviteInspector(RequestInspectorInterface $requestInspector): void
    {
        $this->requestInspector = $requestInspector;
    }
}
