<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Websocket;


interface WebsocketRunnerInterface
{
    public function subscribe(SubscriberInterface $subscriber): void;
    public function unsubscribe(SubscriberInterface $subscriber): void;
    public function getMessage(): MessageInterface;
}
