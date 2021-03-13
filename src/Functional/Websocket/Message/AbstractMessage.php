<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;


use MockingMagician\CoinbaseProSdk\Contracts\Websocket\MessageInterface;

abstract class AbstractMessage implements MessageInterface
{
    private $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}
