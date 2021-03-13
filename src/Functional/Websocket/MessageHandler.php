<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Websocket;


use MockingMagician\CoinbaseProSdk\Contracts\Websocket\MessageInterface;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\AbstractMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ErrorMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\StatusMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\SubscriptionsMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\UnknownMessage;

class MessageHandler
{
    public static function handle(array $payload): ?MessageInterface
    {
        switch ($payload['type']) {
            case 'error':
                return new ErrorMessage($payload);
            case 'subscriptions':
                return new SubscriptionsMessage($payload);
            case 'status':
                return new StatusMessage($payload);
            default:
                return new UnknownMessage($payload);
        }
    }
}
