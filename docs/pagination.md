---
layout: default
title: Pagination
nav_order: 3
---

# 3 : Pagination

***Some queries are paginated. A complete mechanism is provided to manage this pagination with the Pagination object.***

According to Coinbase Pro documentation :

>Cursor pagination can be unintuitive at first. before and after cursor arguments should not be confused with before and after in chronological time. Most paginated requests return the latest information (newest) as the first page sorted by newest (in chronological time) first. To get older information you would request pages after the initial page. To get information newer, you would request pages before the first page.

In order to manage the non-intuitive side of the "before" and "after" fields in the query. The package has been normalized around the more classical concept of "descending" and "ascending".

* The "DESC" direction will retrieve the elements of the most recent direction or the highest value, to the oldest or the smallest value.

* While the "ASC" direction will retrieve the elements of the oldest direction or of the smallest value, to the newer or the highest value.

This standardization allows a better understanding of the path taken by the pagination.

## List of paginated features

```php

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$api->accounts()->getAccountHistoryRaw('132fb6ae-456b-4654-b4e0-d681ac05cea1'); // Paginated request
$api->accounts()->getHolds('132fb6ae-456b-4654-b4e0-d681ac05cea1'); // Paginated request
$api->fills()->listFills(); // Paginated request
$api->deposits()->listDeposits(); // Paginated request
$api->withdrawals()->listWithdrawals(); // Paginated request

```

## How pagination works

Example :

```php

use MockingMagician\CoinbaseProSdk\CoinbaseFacade;
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$accountId = '132fb6ae-456b-4654-b4e0-d681ac05cea1';

$pagination = CoinbaseFacade::createPagination(); // The pagination object

while ($pagination->hasNext()) { // Fetch new page while has next
    $history = $api->accounts()->getAccountHistory($accountId, $pagination);
}

```

Pagination Settings :

```php

use MockingMagician\CoinbaseProSdk\CoinbaseFacade;
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\Pagination;

/** @var ApiInterface $api */

$accountId = '132fb6ae-456b-4654-b4e0-d681ac05cea1';

$pagination = CoinbaseFacade::createPagination( // The pagination object
    Pagination::DIRECTION_DESC, // DESC is default value
    1547662, // An offset cursor value
    25 // The limit on the number of results to bring back per query (max 100)
);

while ($pagination->hasNext()) { // Fetch new page while has next
    $history = $api->accounts()->getAccountHistory($accountId, $pagination);
}

```
