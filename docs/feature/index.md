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

- [Accounts](/feature/accounts.html)
- [Orders](/feature/orders.html)
- [Fills](/feature/fills.html)
- [Limits](/feature/limits.html)
- [Deposits](/feature/deposits.html)
- [Withdrawals](/feature/withdrawals.html)
- [Stablecoin Conversions](/feature/stablecoin-conversions.html)
- [Payment Methods](/feature/payment-methods.html)
- [Coinbase Accounts](/feature/coinbase-accounts.html)
- [Fees](/feature/fees.html)
- [Reports](/feature/reports.html)
- [Profiles](/feature/profiles.html)
- [Margin](/feature/margin.html) (Limited on remote side)
- [Oracle](/feature/oracle.html)
  
- [Products](/feature/products.html)
- [Currencies](/feature/currencies.html)
- [Time](/feature/time.html)
  
Not part of the REST API but fully supported

- [Websocket](/feature/websocket.html)

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
