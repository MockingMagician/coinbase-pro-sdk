---
layout: default
title: Deposits
parent: Features
---


# Deposits methods

```php
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$api->deposits()->listDeposits();
$api->deposits()->getDeposit('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->deposits()->doDeposit(100, 'USD', '132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->deposits()->doDepositFromCoinbase(100, 'USD', '132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->deposits()->generateCryptoDepositAddress('132fb6ae-456b-4654-b4e0-d681ac05cea1');
```
