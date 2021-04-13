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
$api->products()->get24hrStats('BTC-USD');
$api->products()->getProductTicker('BTC-USD');
$api->products()->getProductOrderBook('BTC-USD');
$api->products()->getTrades('BTC-USD');
$api->products()->getSingleProduct('BTC-USD');
$api->products()->getHistoricRates(
    'BTC-USD',
    (new DateTime())->modify('-1 year'),
    new DateTime(),
    3600
);
```
