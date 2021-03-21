---
layout: default
title: Features
has_children: true
nav_order: 2
---

# Features

***In the rest of the documentation, we will assume that you know how to create an CoinbaseApi object and the variable $api will refer to this object.***

## List of features

All features described in the [documentation](https://docs.pro.coinbase.com) are implemented :

- [Accounts](./accounts.html)
- [Orders](./orders.html)
- [Fills](./fills.html)
- [Limits](./limits.html)
- [Deposits](./deposits.html)
- [Withdrawals](./withdrawals.html)
- [Stablecoin Conversions](./stablecoin-conversions.html)
- [Payment Methods](./payment-methods.html)
- [Coinbase Accounts](./coinbase-accounts.html)
- [Fees](./fees.html)
- [Reports](./reports.html)
- [Profiles](./profiles.html)
- [Margin](./margin.html) (Limited on remote side)
- [Oracle](./oracle.html)
  
- [Products](./products.html)
- [Currencies](./currencies.html)
- [Time](./time.html)
  
Not part of the REST API but fully supported

- [Websocket](./websocket.html)

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
