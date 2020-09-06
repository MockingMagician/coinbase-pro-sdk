<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Error;


interface ApiErrorInterface extends \Throwable
{
    public function getApiMessage(): string;
}
