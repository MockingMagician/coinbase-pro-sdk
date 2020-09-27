<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Request;


interface RequestReporterInterface
{
    public function recordRequestData(string $data, string $namespace): void;
}
