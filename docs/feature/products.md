---
layout: default
title: Products
parent: Features
---

# Products methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$api->products()->getProducts();
$api->products()->get24hrStats('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->products()->getProductTicker('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->products()->getProductOrderBook('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->products()->getTrades('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->products()->getSingleProduct('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->products()->getHistoricRates(
    '132fb6ae-456b-4654-b4e0-d681ac05cea1',
    (new DateTime())->modify('-1 year'),
    new DateTime(),
    3600
);

```
