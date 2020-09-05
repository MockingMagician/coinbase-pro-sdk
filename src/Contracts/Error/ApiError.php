<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Error;


interface ApiError extends \Throwable
{
    public function getApiMessage(): string;
}
