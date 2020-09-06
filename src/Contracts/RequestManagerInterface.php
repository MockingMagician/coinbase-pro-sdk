<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


use MockingMagician\CoinbaseProSdk\Functional\Build\Pagination;

interface RequestManagerInterface
{
    public function prepareRequest(string $method, string $routePath, ?string $body = null, ?Pagination $pagination = null): RequestInterface;
}
