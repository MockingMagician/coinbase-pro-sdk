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

## Websocket usage

Simple example :

```php

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ErrorMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Subscriber;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\WebsocketRunner;

/** @var ApiInterface $api */

$subscriber = new Subscriber();
$subscriber->activateChannelLevel2(true, [
    'BTC-EUR',
    'XLM-EUR',
]);

$api->websocket()->run($subscriber, function ($runner) {
    /** @var WebsocketRunner $runner */
    while ($runner->isConnected()) {
        $message = $runner->getMessage();
        if ($message instanceof ErrorMessage) {
            throw new Exception($message->getMessage()); // or break or what you want
        }
        // do something with your message
    }
});

```

## Websocket subscriber

There are two types of subscriber, the simple subscriber and the authenticated subscriber, the latter gives more information about the messages that can be linked to the authenticated user.

AuthenticateSubscriber example

```php

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ErrorMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\SubscriberAuthenticateAware;use MockingMagician\CoinbaseProSdk\Functional\Websocket\WebsocketRunner;

/** @var ApiInterface $api */

$subscriber = new SubscriberAuthenticateAware($api);
$subscriber->runWithAuthentication(true);
$subscriber->activateChannelUser(true, [
    'BTC-EUR',
    'XLM-EUR',
]);

$api->websocket()->run($subscriber, function ($runner) {
    /** @var WebsocketRunner $runner */
    while ($runner->isConnected()) {
        $message = $runner->getMessage();
        if ($message instanceof ErrorMessage) {
            throw new Exception($message->getMessage()); // or break or what you want
        }
        // do something with your message
    }
});

```

Accordind to documentation :

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


## Websocket subscriber in details

```php

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\SubscriberAuthenticateAware;

/** @var ApiInterface $api */

$subscriber = new SubscriberAuthenticateAware($api);

$subscriber->runWithAuthentication(true); // specific to SubscriberAuthenticateAware
$subscriber->activateChannelUser(true, /* optional productsIds */ ['BTC-EUR']); // specific to SubscriberAuthenticateAware

$subscriber->activateChannelLevel2(true, /* optional productsIds */ ['BTC-EUR']);
$subscriber->activateChannelFull(true, /* optional productsIds */ ['BTC-EUR']);
$subscriber->activateChannelHeartbeat(true, /* optional productsIds */ ['BTC-EUR']);
$subscriber->activateChannelMatches(true, /* optional productsIds */ ['BTC-EUR']);
$subscriber->activateChannelTicker(true, /* optional productsIds */ ['BTC-EUR']);

$subscriber->activateChannelStatus(true);

$subscriber->setProductIds([
    'BTC-EUR',
    'XLM-EUR',
]); // Global productIds, activate productIds for all active channels

```
