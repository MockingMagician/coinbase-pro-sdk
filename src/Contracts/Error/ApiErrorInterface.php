<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Error;


use Throwable;

interface ApiErrorInterface extends Throwable
{
    public function getApiMessage(): string;
}
