---
layout: default
title: Withdrawals
parent: Features
---

# Withdrawals methods

```php
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$api->withdrawals()->listWithdrawals();
$api->withdrawals()->getWithdrawal('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->withdrawals()->doWithdraw(100, 'USD', '132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->withdrawals()->doWithdrawToCoinbase(100, 'USD', '132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->withdrawals()->doWithdrawToCryptoAddress(0.1, 'BTC', 'bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq');
$api->withdrawals()->getFeeEstimate('BTC', 'bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq');
```
