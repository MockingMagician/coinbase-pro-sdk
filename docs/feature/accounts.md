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
$api->accounts()->getAccount('BTC');
$api->accounts()->getAccountHistory('XTZ');
$api->accounts()->getHolds('132fb6ae-456b-4654-b4e0-d681ac05cea1');
```

## `list(): AccountData[]`

```php
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$accounts = $api->accounts()->list();

foreach ($accounts as $account) {
  // ...
}
```

## `getAccount(string $accountId): AccountData`

```php
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$account = $api->accounts()->getAccount('BTC');
```

### The AccountData object

```php
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$account = $api->accounts()->getAccount('BTC');

$account->getId(); // The account id
$account->getProfileId(); // The profile id attached to this account
$account->getCurrency(); // Currency of the account
$account->getBalance(); // Balance of the account
$account->getHoldFunds(); // Funds hold on orders
$account->getAvailableFunds(); // Available funds (Balance minus Hold funds)
$account->isTradingEnabled(); // The account id
```

<h2 id="getAccountHistory">
<code 
class="language-plaintext highlighter-rouge" 
style="display: block;">
<pre>
getAccountHistory(
    string $accountId
    [, PaginationInterface $pagination]
): AccountHistoryEventData[]
</pre>
</code>
</h2>

### And the AccountHistoryEventData object

```php
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$history = $api->accounts()->getAccountHistory('BTC');

foreach ($history as $historyEventData) {
    $historyEventData->getId(); // id of the event
    $historyEventData->getAmount(); // amount engaged in the event
    $historyEventData->getType(); // one of AccountHistoryEventDataInterface::TYPES
    $historyEventData->getBalance(); // balance after event
    $historyEventData->getCreatedAt(); // creation datetime of the event
    $historyEventData->getDetails();
}
```

