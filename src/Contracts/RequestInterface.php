<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


interface RequestInterface
{
    public function signAndSend();
    public function send();
}
