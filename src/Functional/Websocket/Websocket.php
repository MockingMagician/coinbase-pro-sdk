<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket;

use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\WebsocketInterface;

class Websocket implements WebsocketInterface
{
    /**
     * @var WebsocketRunner
     */
    private $runner;

    public function __construct(WebsocketRunner $runner)
    {
        $this->runner = $runner;
    }

    public function run(SubscriberInterface $subscriber, callable $userFunc, ...$args): void
    {
        $this->runner->connect();
        $this->runner->subscribe($subscriber);
        $userFunc($this->runner, ...$args);
        $this->runner->close();
    }
}
