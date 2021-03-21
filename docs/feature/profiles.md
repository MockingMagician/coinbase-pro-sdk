---
layout: default
title: Profiles
parent: Features
---

# Profiles methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

/** @var ApiInterface $api */

$api->profiles()->listProfiles(true /* list active only or not */);
$api->profiles()->getProfile('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->profiles()->createProfileTransfer('132fb6ae-456b-4654-b4e0-d681ac05cea1', '742fb6ae-145f-8954-b4e0-d681ac05cea1', 'USD', 500);

```
