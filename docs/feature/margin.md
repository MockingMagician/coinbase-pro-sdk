---
layout: default
title: Margin
parent: Features
---

# Margin methods

```php
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$api->margin()->getMarginStatus(); // Returns the status of margin API

/*

As long as the margin functionality is not enabled, the methods below could not be fully tested. 

A decorator protects the method call as long as the status of the API on the coinbase side does not return an active and eligible status.

$api->margin()->getExitPlan();
$api->margin()->getBuyingPower();
$api->margin()->getWithdrawalPower();
$api->margin()->listLiquidationHistory();
$api->margin()->getAllWithdrawalPowers();
$api->margin()->getPositionsRefreshAmount();
$api->margin()->getMarginProfileInformation();

*/
```
