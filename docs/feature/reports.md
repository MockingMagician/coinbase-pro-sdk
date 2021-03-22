---
layout: default
title: Reports
parent: Features
---

# Reports methods

```php
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ReportsInterface;

/** @var ApiInterface $api */

$api->reports()->createNewReport(
    ReportsInterface::TYPE_FILLS,
    (new DateTime())->modify('-1 year'),
    new DateTime(),
    null, // Optional
    '', // Optional
    ReportsInterface::FORMAT_PDF,
    null // Optional, if filled report will be sent to this email
);
$api->reports()->getReportStatus('132fb6ae-456b-4654-b4e0-d681ac05cea1');
```
