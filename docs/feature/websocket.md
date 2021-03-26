---
layout: default
title: Websocket
parent: Features
---

# Websocket

## Overview

***According to [documentation](https://docs.pro.coinbase.com/#websocket-feed)***

Real-time market data updates provide the fastest insight into order flow and trades. This however means that you are responsible for reading the message stream and using the message relevant for your needs which can include building real-time order books or tracking real-time trades.

The websocket feed is publicly available, but connections to it are rate-limited to 1 per 4 seconds per IP, messages sent by client on each connection are rate-limited to 100 per second per IP.

Because the websocket is public, an access method without any connection parameters is available in [CoinbaseFacade](../coinbase-facade.md#websocket)

## Websocket usage

Unauthenticated example :

```php
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ErrorMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\WebsocketRunner;

$websocket = CoinbaseFacade::createUnauthenticatedWebsocket();

$subscriber = $websocket->newSubscriber();
$subscriber->activateChannelLevel2(true, [
    'BTC-EUR',
    'XLM-EUR',
]);

$websocket->run($subscriber, function ($runner) {
    /** @var WebsocketRunner $runner */
    while ($runner->isConnected()) {
        $message = $runner->getMessage();
        if ($message instanceof ErrorMessage) {
            throw new Exception($message->getMessage()); 
            // or break or what you want
        }
        // do something with your message
    }
});
```

Authenticated example :

```php
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ErrorMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\WebsocketRunner;

/** @var ApiInterface $api */

$websocket = $api->websocket();

$subscriber = $websocket->newSubscriber();
$subscriber->activateChannelLevel2(true, [
    'BTC-EUR',
    'XLM-EUR',
]);

$subscriber->activateChannelUser(true, [
    'BTC-EUR',
    'XLM-EUR',
]); // Using this method in any other context than in an authenticated manner will result in an error

$websocket->run($subscriber, function ($runner) {
    /** @var WebsocketRunner $runner */
    while ($runner->isConnected()) {
        $message = $runner->getMessage();
        if ($message instanceof ErrorMessage) {
            throw new Exception($message->getMessage()); 
            // or break or what you want
        }
        // do something with your message
    }
});
```

## Websocket subscriber

```php
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberAuthenticationAwareInterface;

/** @var SubscriberAuthenticationAwareInterface $subscriber */

$subscriber->setProductIds([
    'BTC-EUR',
    'XLM-EUR',
]); // Global productIds, activate productIds list for all activated channels

$subscriber->activateChannelLevel2(
    true,
    ['BTC-EUR'] // optional productsIds to listen for this channel
);
$subscriber->activateChannelFull(
    true,
    ['BTC-EUR'] // optional productsIds to listen for this channel
);
$subscriber->activateChannelHeartbeat(
    true,
    ['BTC-EUR'] // optional productsIds to listen for this channel
);
$subscriber->activateChannelMatches(
    true,
    ['BTC-EUR'] // optional productsIds to listen for this channel
);
$subscriber->activateChannelTicker(
    true,
    ['BTC-EUR'] // optional productsIds to listen for this channel
);
$subscriber->activateChannelStatus(true);

$subscriber->activateChannelUser( // only in authenticated context
    true,
    ['BTC-EUR'] // optional productsIds to listen for this channel
);
```

According to documentation :

> The user channel is a version of the full channel that only contains messages that include the authenticated user. Consequently, you need to be authenticated to receive any messages.

[Link to documentation](https://docs.pro.coinbase.com/#the-user-channel)

> MATCH messages :  
> 
> If authenticated, and you were the taker, the message would also have the following fields:
> 
> - taker_user_id: "5844eceecf7e803e259d0365"
> - user_id: "5844eceecf7e803e259d0365"
> - taker_profile_id: "765d1549-9660-4be2-97d4-fa2d65fa3352"
> - profile_id: "765d1549-9660-4be2-97d4-fa2d65fa3352"
> - taker_fee_rate: "0.005"
> 
> Similarly, if you were the maker, the message would have the following:
> 
> - taker_user_id: "5844eceecf7e803e259d0365"
> - user_id: "5844eceecf7e803e259d0365"
> - taker_profile_id: "765d1549-9660-4be2-97d4-fa2d65fa3352"
> - profile_id: "765d1549-9660-4be2-97d4-fa2d65fa3352"
> - taker_fee_rate: "0.005"

[Link to documentation](https://docs.pro.coinbase.com/#the-full-channel)

## Websocket messages

```php
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberAuthenticationAwareInterface;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ActivateMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ChangeMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\DoneMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ErrorMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\HeartbeatMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\L2UpdateMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\LastMatchMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\MatchMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\OpenMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ReceivedMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\SnapshotMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\StatusMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\SubscriptionsMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\TickerMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\UnknownMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Websocket;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\WebsocketRunner;

/** @var Websocket $websocket */
/** @var SubscriberAuthenticationAwareInterface $subscriber */

$websocket->run($subscriber, function ($runner) {
    /** @var WebsocketRunner $runner */
    while ($runner->isConnected()) {
        $message = $runner->getMessage();
        
        if ($message instanceof ErrorMessage) {
            $message_ = $message->getMessage();
            $reason = $message->getReason();
            
            throw new Exception("$message_. $reason");
        }
        
        if ($message instanceof ActivateMessage) {
            $time = $message->getTime();
            $side = $message->getSide();
            $productId = $message->getProductId();
            $orderId = $message->getOrderId();
            $isPrivate = $message->isPrivate();
            $userId = $message->getUserId();
            $funds = $message->getFunds();
            $profileId = $message->getProfileId();
            $size = $message->getSize();
            $stopPrice = $message->getStopPrice();
            
            echo sprintf(
                'At %s, user %s has activate a stop order with id %s', 
                $time,
                $userId,
                $orderId
            );
            
            continue;
        }
        
        if ($message instanceof ChangeMessage) {
            $newFunds = $message->getNewFunds();
            $newSize = $message->getNewSize();
            $oldFunds = $message->getOldFunds();
            $oldSize  = $message->getOldSize();
            $orderId = $message->getOrderId();
            $price = $message->getPrice();
            $sequence = $message->getSequence();
            $productId = $message->getProductId();
            $side = $message->getSide();
            $time = $message->getTime();
            
            echo sprintf(
                'At %s, order %s has changed', 
                $time,
                $orderId
            );
            
            continue;
        }
        
        if ($message instanceof DoneMessage) {
            $orderId = $message->getOrderId();
            $price = $message->getPrice();
            $sequence = $message->getSequence();
            $productId = $message->getProductId();
            $side = $message->getSide();
            $time = $message->getTime();
            $reason = $message->getReason();
            $remainingSize = $message->getRemainingSize();
            
            echo sprintf(
                'At %s, order %s has done cause %s', 
                $time,
                $orderId,
                $reason
            );
            
            continue;
        }
        
        if ($message instanceof HeartbeatMessage) {
            $sequence = $message->getSequence();
            $productId = $message->getProductId();
            $time = $message->getTime();
            $lastTradeId = $message->getLastTradeId();
            
            echo sprintf(
                'At %s, product %s last trade id was %s', 
                $time,
                $productId,
                $lastTradeId
            );
            
            continue;
        }
        
        if ($message instanceof L2UpdateMessage) {
            $productId = $message->getProductId();
            $time = $message->getTime();
            $changes = $message->getChanges();
            
            foreach ($changes as $change) {
                $size = $change->getSize();
                $side = $change->getSide();
                $price = $change->getPrice();
            
                echo sprintf(
                    'At %s, product %s has changed at size %s in side %s, price is %s', 
                    $time,
                    $productId,
                    $size,
                    $side,
                    $price
                );
            }
            
            continue;
        }
        
        if ($message instanceof LastMatchMessage) {
            $productId = $message->getProductId();
            $time = $message->getTime();
            $side = $message->getSide();
            $makerOrderId = $message->getMakerOrderId();
            $takerOrderId = $message->getTakerOrderId();
            $tradeId = $message->getTradeId();
            $size = $message->getSize();
            
            echo sprintf(
                'Last match for product %s at %s was trade id %s', 
                $productId,
                $time,
                $tradeId
            );
            
            continue;
        }
        
        if ($message instanceof MatchMessage) {
            $productId = $message->getProductId();
            $time = $message->getTime();
            $side = $message->getSide();
            $makerOrderId = $message->getMakerOrderId();
            $takerOrderId = $message->getTakerOrderId();
            $tradeId = $message->getTradeId();
            $size = $message->getSize();
            
            echo sprintf(
                'Product %s has made a trade match at %s, trade id is %s', 
                $productId,
                $time,
                $tradeId
            );
            
            continue;
        }
        
        if ($message instanceof OpenMessage) {
            $productId = $message->getProductId();
            $time = $message->getTime();
            $side = $message->getSide();
            $orderId = $message->getOrderId();
            $price = $message->getPrice();
            $remainingSize = $message->getRemainingSize();
            $sequence = $message->getSequence();
            
            echo sprintf(
                'At %s, an order with id %s was open on product %s', 
                $time,
                $orderId,
                $productId
            );
            
            continue;
        }
        
        if ($message instanceof ReceivedMessage) {
            $productId = $message->getProductId();
            $time = $message->getTime();
            $side = $message->getSide();
            $orderId = $message->getOrderId();
            $price = $message->getPrice();
            $sequence = $message->getSequence();
            $size = $message->getSize();
            $orderType = $message->getOrderType();
            $clientOrderId = $message->getClientOrderId();
            
            echo sprintf(
                'At %s, an order with id %s was received on product %s', 
                $time,
                $orderId,
                $productId
            );
            
            continue;
        }
        
        if ($message instanceof SnapshotMessage) {
            $productId = $message->getProductId();
            $asks = $message->getAsks();
            $bids = $message->getBids();
            
            foreach ($asks as $ask) {
                $size = $ask->getSize();
                $price = $ask->getPrice();
            
                echo sprintf(
                    'Product %s has ask size % at price %s', 
                    $productId,
                    $size,
                    $price
                );
            }
            
            foreach ($bids as $bid) {
                $size = $bid->getSize();
                $price = $bid->getPrice();
            
                echo sprintf(
                    'Product %s has bid size % at price %s', 
                    $productId,
                    $size,
                    $price
                );
            }
            
            continue;
        }
        
        if ($message instanceof StatusMessage) {
            $currencies = $message->getCurrencies();
            $products = $message->getProducts();
            
            foreach ($currencies as $currency) {
                // each currency is \MockingMagician\CoinbaseProSdk\Functional\DTO\CurrencyData
            }
            
            foreach ($products as $product) {
                // each currency is \MockingMagician\CoinbaseProSdk\Functional\DTO\ProductData
            }
            
            continue;
        }
        
        if ($message instanceof SubscriptionsMessage) {
            $channels = $message->getChannels();
            
            foreach ($channels as $channel) {
                $name = $channel->getName();
                $productIds = $channel->getProductIds();
            
                echo sprintf(
                    'You have subscribe to channel %s with product ids : %s', 
                    $name,
                    implode(', ', $productIds)
                );
            }
            
            continue;
        }
        
        if ($message instanceof TickerMessage) {
            $message->getPrice();
            $message->getBestAsk();
            $message->getBestBid();
            $message->getHigh24h();
            $message->getLastSize();
            $message->getLow24h();
            $message->getOpen24h();
            $message->getVolume24h();
            $message->getVolume30d();
            $message->getTradeId();
            $message->getSide();
            $message->getProductId();
            $message->getTime();
            $message->getSequence();
            $message->getTime();
            
            continue;
        }
        
        if ($message instanceof UnknownMessage) {
            $payload = $message->getPayload();
            $type = $payload['type'];
            Json::encode($payload);
            
             echo sprintf(
                'This message of type %s is not yet implemented, payload looks as is : %s', 
                $type,
                $payload
            );
            
            continue;
        }
    }
});
```
