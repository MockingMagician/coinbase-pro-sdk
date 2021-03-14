<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket;

use MockingMagician\CoinbaseProSdk\Contracts\Websocket\MessageInterface;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\DoneMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ErrorMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\HeartbeatMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\L2UpdateMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\MatchMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\OpenMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ReceivedMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\SnapshotMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\StatusMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\SubscriptionsMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\TickerMessage;
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
            case 'snapshot':
                return new SnapshotMessage($payload);
            case 'ticker':
                return new TickerMessage($payload);
            case 'l2update':
                return new L2UpdateMessage($payload);
            case 'heartbeat':
                return new HeartbeatMessage($payload);
            case 'received':
                return new ReceivedMessage($payload);
            case 'open':
                return new OpenMessage($payload);
            case 'done':
                return new DoneMessage($payload);
            case 'match':
                return new MatchMessage($payload);
            default:
                return new UnknownMessage($payload);
        }
    }
}
