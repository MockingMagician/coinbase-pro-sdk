---
layout: default
title: Stablecoin Conversions
parent: Features
---

# Stablecoin Conversions methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$api->stablecoinConversions()->createConversion('USD', 'USDC', 100);

```
