<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


interface RequestManagerInterface
{
    public function prepareRequest(string $method, string $routePath, ?string $body = null): RequestInterface;
}
