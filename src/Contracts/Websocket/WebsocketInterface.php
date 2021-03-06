<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Websocket;


interface WebsocketInterface
{
    /**
     * @param SubscriberInterface $subscriber
     * @param callable(WebsocketInterface $websocket, ...$args) $userFunc
     * @param mixed ...$args
     */
    public function run(SubscriberInterface $subscriber, callable $userFunc, ...$args): void;
}
