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
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestReporterAwareInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestReporterInterface;

class RequestFactory implements RequestFactoryInterface, RequestReporterAwareInterface
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
     * @var null|RequestReporterInterface
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

        // @codeCoverageIgnoreStart
        if ($this->requestInspector) {
            $request->inviteReporter($this->requestInspector);
        }
        // @codeCoverageIgnoreEnd

        return new RequestWithErrorManagement(
            $request,
            $this->manageRateLimits
        );
    }

    /**
     * @codeCoverageIgnore
     */
    public function inviteReporter(RequestReporterInterface $requestInspector): void
    {
        $this->requestInspector = $requestInspector;
    }
}
