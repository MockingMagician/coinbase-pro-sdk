<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


interface ApiParamsInterface
{
    public function getEndPoint(): string;
    public function getKey(): string;
    public function getSecret(): string;
    public function getPassphrase(): string;
}
