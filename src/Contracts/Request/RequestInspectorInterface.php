<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Request;


interface RequestInspectorInterface
{
    public function recordRequestData(string $data, string $namespace): void;
}
