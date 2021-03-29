<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket;

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberAuthenticationAwareInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\WebsocketInterface;

class Websocket implements WebsocketInterface
{
    /**
     * @var WebsocketRunner
     */
    private $runner;
    /**
     * @var null|ApiInterface
     */
    private $api;
    /**
     * @var null|TimeInterface
     */
    private $time;

    public function __construct(WebsocketRunner $runner, ?ApiInterface $api = null, ?TimeInterface $time = null)
    {
        $this->runner = $runner;
        $this->api = $api;
        $this->time = $time;
    }

    public function newSubscriber(): SubscriberAuthenticationAwareInterface
    {
        if (isset($this->api)) {
            return new SubscriberAuthenticated($this->api, $this->time);
        }

        return new Subscriber();
    }

    public function run(SubscriberInterface $subscriber, callable $userFunc, ...$args): void
    {
        $this->runner->connect();
        $this->runner->subscribe($subscriber);
        $userFunc($this->runner, ...$args);
        $this->runner->close();
    }
}
