<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;

interface RequestManagerInterface
{
    public function prepareRequest(
        string $method,
        string $routePath,
        array $queryArgs = [],
        ?string $body = null,
        ?PaginationInterface $pagination = null
    ): RequestInterface;
}
