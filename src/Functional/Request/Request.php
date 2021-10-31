<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Request;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ParamsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestReporterAwareInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestReporterInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\Pagination;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use MockingMagician\CoinbaseProSdk\Functional\Error\CurlErrorToManaged;
use MockingMagician\CoinbaseProSdk\Functional\Error\RateLimitsErrorToManaged;
use MockingMagician\CoinbaseProSdk\Functional\Error\TimestampExpiredErrorToManaged;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Signer;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Throwable;

class Request implements RequestInterface, RequestReporterAwareInterface
{
    const CURL_ERRORS_TO_MANAGE__REGEX = [
        'connection reset by peer',
        'empty reply from server',
        'error 35',
    ];

    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var string
     */
    private $method;
    /**
     * @var string
     */
    private $routePath;
    /**
     * @var string
     */
    private $body;
    /**
     * @var ParamsInterface
     */
    private $apiParams;
    /**
     * @var null|TimeInterface
     */
    private $time;
    /**
     * @var null|PaginationInterface
     */
    private $pagination;
    /**
     * @var array<string, string>
     */
    private $queryArgs;
    /**
     * @var bool
     */
    private $mustBeSigned;
    /**
     * @var null|RequestReporterInterface
     */
    private $requestInspector;

    /**
     * Request constructor.
     *
     * @param array<string, string> $queryArgs
     */
    public function __construct(
        ClientInterface $client,
        ParamsInterface $apiParams,
        string $method,
        string $routePath,
        array $queryArgs = [],
        ?string $body = null,
        ?PaginationInterface $pagination = null,
        bool $mustBeSigned = true,
        ?TimeInterface $time = null
    ) {
        $this->client = $client;
        $this->method = $method;
        $this->routePath = $routePath;
        $this->body = $body;
        $this->apiParams = $apiParams;
        $this->time = $time;
        $this->pagination = $pagination;
        $this->queryArgs = $queryArgs;
        $this->mustBeSigned = $mustBeSigned;
    }

    public function send(): string
    {
        $request = $this->buildRequest();

        try {
            $response = $this->client->send($request);
        } catch (BadResponseException $exception) {
            $message = $exception->getMessage();

            if (!$exception->hasResponse()) {
                throw new ApiError($exception->getMessage());
            }

            if (429 === $exception->getResponse()->getStatusCode()) {
                throw new RateLimitsErrorToManaged();
            }

            if (($array = Json::decode($exception->getResponse()->getBody()->getContents(), true))
                && isset($array['message'])
            ) {
                $message = $array['message'];
                if ('request timestamp expired' === $message) {
                    throw new TimestampExpiredErrorToManaged();
                }
            }

            throw new ApiError($message);
        } catch (Throwable $exception) {
            if (preg_match('#'.implode('|', self::CURL_ERRORS_TO_MANAGE__REGEX).'#i', $exception->getMessage())) {
                throw new CurlErrorToManaged();
            }

            throw new ApiError($exception->getMessage());
        }

        if ($this->pagination) {
            $this->pagination->autoPaginateFromHeaders(
                $response->getHeader(Pagination::HEADER_BEFORE)[0] ?? null,
                $response->getHeader(Pagination::HEADER_AFTER)[0] ?? null
            );
        }

        $content = $response->getBody()->getContents();

        // @codeCoverageIgnoreStart
        if ($this->requestInspector) {
            $this->requestInspector->recordRequestData($content, $this->routePath);
        }
        // @codeCoverageIgnoreEnd

        return $content;
    }

    public function setMustBeSigned(bool $set): RequestInterface
    {
        $this->mustBeSigned = $set;

        return $this;
    }

    /**
     * @codeCoverageIgnore
     */
    public function inviteReporter(RequestReporterInterface $requestInspector): void
    {
        $this->requestInspector = $requestInspector;
    }

    private function buildRequest(): PsrRequestInterface
    {
        if ($this->mustBeSigned) {
            return $this->buildSignedRequest();
        }

        return new GuzzleRequest(
            $this->method,
            $this->getUri(),
            [
                'Content-Type' => 'application/json',
            ],
            $this->body
        );
    }

    private function buildSignedRequest(): PsrRequestInterface
    {
        $signData = Signer::sign(
            $this->apiParams->getKey(),
            $this->apiParams->getSecret(),
            $this->apiParams->getPassphrase(),
            $this->method,
            $this->getFullRoutePath(),
            $this->body ?? '',
            $this->getTime()
        );

        return new GuzzleRequest(
            $this->method,
            $this->getUri(),
            [
                'CB-ACCESS-KEY' => $signData->getKey(),
                'CB-ACCESS-SIGN' => $signData->getSignature(),
                'CB-ACCESS-TIMESTAMP' => (string) $signData->getTimestamp(),
                'CB-ACCESS-PASSPHRASE' => $signData->getPassphrase(),
                'Content-Type' => 'application/json',
            ],
            $this->body
        );
    }

    private function getTime(): float
    {
        if ($this->time) {
            try {
                return $this->time->getTime()->getEpoch();
            } catch (Throwable $exception) {
            }
        }

        return microtime(true);
    }

    private function getQueryString(): string
    {
        if ($this->pagination) {
            return http_build_query(array_merge($this->queryArgs, $this->pagination->getQueryArgs()));
        }

        return http_build_query($this->queryArgs);
    }

    private function getFullRoutePath(): string
    {
        if (!empty($query = $this->getQueryString())) {
            return $this->routePath.'?'.$query;
        }

        return $this->routePath;
    }

    private function getUri(): string
    {
        return $this->apiParams->getEndPoint().$this->getFullRoutePath();
    }
}
