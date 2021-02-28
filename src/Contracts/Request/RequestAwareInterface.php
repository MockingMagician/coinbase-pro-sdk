<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Request;


interface RequestAwareInterface
{
    public function getRequestFactory(): RequestFactoryInterface;
}
