<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


interface ApiError extends \Throwable
{
    public function getApiMessage(): string;
}
