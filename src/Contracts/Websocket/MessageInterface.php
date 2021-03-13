<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Websocket;


interface MessageInterface
{
    public function getPayload(): array;
}
