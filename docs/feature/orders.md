---
layout: default
title: Orders
parent: Features
---

# Orders methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$api->orders()->getOrderById('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->orders()->listOrders();
$api->orders()->cancelOrderById('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->orders()->cancelAllOrders();
$api->orders()->cancelOrderByClientOrderId('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->orders()->getOrderByClientOrderId('132fb6ae-456b-4654-b4e0-d681ac05cea1');

```

## How to place an order

### Place market order

```php

use MockingMagician\CoinbaseProSdk\CoinbaseFacade;
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\MarketOrderToPlace;

/** @var ApiInterface $api */

$marketOrder = CoinbaseFacade::createMarketOrderToPlace(
    MarketOrderToPlace::SIDE_BUY, 
    'BTC-USD',
    0.0001
);

$api->orders()->placeOrder($marketOrder);

```

### Place limit order

```php

use MockingMagician\CoinbaseProSdk\CoinbaseFacade;
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\LimitOrderToPlace;

/** @var ApiInterface $api */

$limitOrder = CoinbaseFacade::createLimitOrderToPlace(
    LimitOrderToPlace::SIDE_BUY,
    'BTC-USD',
    10000,
    0.0001
);

$api->orders()->placeOrder($limitOrder);

```

## Understanding orders

***For a good understanding of the orders and parameters available for each order, please refer to the [Coinbase Pro documentation](https://docs.pro.coinbase.com/#orders), as well as the documentation available in the interfaces of this package.***

Example of complex orders :

- Market

```php

use MockingMagician\CoinbaseProSdk\CoinbaseFacade;
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\MarketOrderToPlace;

/** @var ApiInterface $api */

$marketOrder = CoinbaseFacade::createMarketOrderToPlace(
    MarketOrderToPlace::SIDE_BUY,
    'BTC-USD',
    0.0001, // null if funds is set and "vice versa"
    null, // null if size is set and "vice versa"
    MarketOrderToPlace::SELF_TRADE_PREVENTION_DECREASE_AND_CANCEL, // The self trade prevention flag
    MarketOrderToPlace::STOP_LOSS, // Direction flag for stop
    1000, // Stop price
    '132fb6ae-456b-4654-b4e0-d681ac05cea1' // A custom id that you defined (UUID format only)
);

$api->orders()->placeOrder($marketOrder);

```

- Limit

```php

use MockingMagician\CoinbaseProSdk\CoinbaseFacade;
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\LimitOrderToPlace;

/** @var ApiInterface $api */

$limitOrder = CoinbaseFacade::createLimitOrderToPlace(
    LimitOrderToPlace::SIDE_BUY,
    'BTC-USD',
    10000, // Price
    0.0001, // Sice
    LimitOrderToPlace::TIME_IN_FORCE_GOOD_TILL_CANCELED, // The TIF flag
    LimitOrderToPlace::CANCEL_AFTER_DAY, // A cancel after time
    true, // Define if post-only or taker allowed, post_only is disabled by default
    LimitOrderToPlace::SELF_TRADE_PREVENTION_DECREASE_AND_CANCEL, // The self trade prevention flag,
    LimitOrderToPlace::STOP_LOSS, // Direction flag for stop
    1000, // Stop price
    '132fb6ae-456b-4654-b4e0-d681ac05cea1' // A custom id that you defined (UUID format only)
);

$api->orders()->placeOrder($limitOrder);

```
