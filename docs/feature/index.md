---
layout: default
title: Features
has_children: true
nav_order: 2
has_toc: false
---

# Features

***In the rest of the documentation, we will assume that you know how to create an CoinbaseApi object and the variable $api will refer to this object.***

## List of features

All features described in the [documentation](https://docs.pro.coinbase.com) are implemented :

- [Accounts](./accounts.md)
- [Orders](./orders.md)
- [Fills](./fills.md)
- [Limits](./limits.md)
- [Deposits](./deposits.md)
- [Withdrawals](./withdrawals.md)
- [Stablecoin Conversions](./stablecoin-conversions.md)
- [Payment Methods](./payment-methods.md)
- [Coinbase Accounts](./coinbase-accounts.md)
- [Fees](./fees.md)
- [Reports](./reports.md)
- [Profiles](./profiles.md)
- [Margin](./margin.md) (Limited on remote side)
- [Oracle](./oracle.md)
  
- [Products](./products.md)
- [Currencies](./currencies.md)
- [Time](./time.md)
  
Not part of the REST API but fully supported

- [Websocket](./websocket.md)

```php
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$api->accounts();
$api->orders();
$api->fills();
$api->limits();
$api->deposits();
$api->withdrawals();
$api->stablecoinConversions();
$api->paymentMethods();
$api->coinbaseAccounts();
$api->fees();
$api->reports();
$api->profiles();
$api->margin();
$api->oracle();

$api->products();
$api->currencies();
$api->time();

$api->websocket();
```
