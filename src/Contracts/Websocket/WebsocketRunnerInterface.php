<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Websocket;

interface WebsocketRunnerInterface
{
    public const WEBSOCKET_URI = 'wss://ws-feed.pro.coinbase.com';

    public function connect(): void;

    public function close(): void;

    public function subscribe(SubscriberInterface $subscriber): void;

    public function unsubscribe(SubscriberInterface $subscriber): void;

    public function getMessage(): MessageInterface;
}
