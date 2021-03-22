---
layout: default
title: Accounts
parent: Features
---

# Accounts methods

```php
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$api->accounts()->list();
$api->accounts()->getAccount('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->accounts()->getAccountHistory('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->accounts()->getHolds('132fb6ae-456b-4654-b4e0-d681ac05cea1');
```
