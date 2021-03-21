<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket;

use function Amp\Promise\wait;
use function Amp\Websocket\Client\connect;
use Amp\Websocket\Client\Connection;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\MessageInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\WebsocketRunnerInterface;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

class WebsocketRunner implements WebsocketRunnerInterface
{
    /**
     * @var null|Connection
     */
    private $connection;

    public function __construct()
    {
        $this->connection = null;
    }

    public function connect(): void
    {
        if (!is_null($this->connection)) {
            return;
        }

        $this->connection = wait(connect(self::WEBSOCKET_URI));
    }

    public function close(): void
    {
        if (is_null($this->connection)) {
            return;
        }
        $this->connection->close();
        $this->connection = null;
    }

    public function subscribe(SubscriberInterface $subscriber): void
    {
        wait($this->connection->send(Json::encode($subscriber->getPayload())));
    }

    public function unsubscribe(SubscriberInterface $subscriber): void
    {
        wait($this->connection->send(Json::encode($subscriber->getPayload(true))));
    }

    public function getMessage(): MessageInterface
    {
        $message = wait($this->connection->receive());
        $payload = wait($message->buffer());

        return MessageHandler::handle(Json::decode($payload, true));
    }
}
