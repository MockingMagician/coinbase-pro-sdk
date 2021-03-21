<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Websocket;

interface WebsocketInterface
{
    /**
     * @param callable $userFunc (WebsocketRunnerInterface $websocket, ...$args):void
     * @param mixed    ...$args
     */
    public function run(SubscriberInterface $subscriber, callable $userFunc, ...$args): void;
}
