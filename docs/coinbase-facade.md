---
layout: default
title: Coinbase Facade
nav_order: 1
---

# CoinbaseFacade

## Create an CoinbaseApi object

### Full API access with default features

```php
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;

$api = CoinbaseFacade::createDefaultCoinbaseApi(
    'API_ENDPOINT',
    'API_KEY',
    'API_SECRET',
    'API_PASSPHRASE'
);
```
### Customize API

```php
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;

$config = CoinbaseFacade::createDefaultCoinbaseConfig(
    'API_ENDPOINT',
    'API_KEY',
    'API_SECRET',
    'API_PASSPHRASE'
);

// Choose to activate or deactivate some of the API endpoints
$config->getConnectivityConfig()
    ->activateAccounts(false)
    ->activateOrders(false)
    ->activateFills(false)
    ->activateLimits(false)
    ->activateDeposits(false)
    ->activateWithdrawals(false)
    ->activateStablecoinConversions(false)
    ->activatePaymentMethods(false)
    ->activateCoinbaseAccounts(false)
    ->activateFees(false)
    ->activateReports(false)
    ->activateProfiles(false)
    ->activateMargin(false)
    ->activateOracle(false)
    ->activateProducts(false)
    ->activateCurrencies(false)
    ->activateTime(false)
;

// Enable or disable the use of remote time during the requests, default to false
$config->setUseCoinbaseRemoteTime(true);
// Enable or disable management of rate limits imposed by remote API, default to true
$config->setManageRateLimits(true);
// Enable or disable the use of a security layer that encrypt parameters used each time by the requests, default to true
$config->setUseSecurityLayerForParams(true);

$api = CoinbaseFacade::createCoinbaseApi($config);
```
### Create from yaml config file

```php
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;

$api = CoinbaseFacade::createCoinbaseApiFromYaml('path/to/config.yaml');
```
Example of a complete configuration file :

```yaml
params: 
    # endpoint: '${SOME_ENV}' <= formatting as is autoload SOME_ENV (if exist)
    endpoint: '${API_ENDPOINT}'
    key: '${API_KEY}'
    secret: '${API_SECRET}'
    passphrase: '${API_PASSPHRASE}'

connectivity:
    accounts: true # default
    coinbase_accounts: true # default
    currencies: true # default
    deposits: true # default
    fees: true # default
    fills: true # default
    limits: true # default
    margin: true # default
    oracle: true # default
    orders: true # default
    payment_methods: true # default
    products: true # default
    profiles: true # default
    reports: true # default
    stablecoin_conversions: true # default
    time: true # default
    withdrawals: true # default

remote_time: false # default

manage_rate_limits: true # default

secure_params: true # default
```
Minimal configuration file :

```yaml
params: 
    endpoint: '${API_ENDPOINT}'
    key: '${API_KEY}'
    secret: '${API_SECRET}'
    passphrase: '${API_PASSPHRASE}'
```
### Time in API request

According to documentation :

>Selecting a Timestamp
>
>The CB-ACCESS-TIMESTAMP header MUST be number of seconds since Unix Epoch in UTC. Decimal values are allowed.
>
>Your timestamp must be within 30 seconds of the api service time or your request will be considered expired and rejected. We recommend using the time endpoint to query for the API server time if you believe there many be time skew between your server and the API servers.

The package is designed to handle this situation.

In order to ensure good timestamp in requests, you just need to activate the functionality and the requests will use the timestamp provided by the Coinbase server.

***This feature makes network calls in order to retrieve the timestamp, thus increasing the number of requests made.***

***The feature is disabled by default.***

Example 1 :

```php
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;

$config = CoinbaseFacade::createDefaultCoinbaseConfig(
    'API_ENDPOINT',
    'API_KEY',
    'API_SECRET',
    'API_PASSPHRASE'
);

$config->setUseCoinbaseRemoteTime(true); // pass true here to enable the remote timestamp provided by the remote Coinbase server

$api = CoinbaseFacade::createCoinbaseApi($config);
```
Example 2 :

```php
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;

$api = CoinbaseFacade::createCoinbaseApiFromYaml('path/to/config.yaml');
```
Config file :

```yaml
params: 
    endpoint: '${API_ENDPOINT}'
    key: '${API_KEY}'
    secret: '${API_SECRET}'
    passphrase: '${API_PASSPHRASE}'

remote_time: true # pass true here to enable the remote timestamp provided by the remote Coinbase server
```
### API rate limits

According to documentation :

>When a rate limit is exceeded, a status of 429 Too Many Requests will be returned.
>
>PUBLIC ENDPOINTS
>
>We throttle public endpoints by IP: 3 requests per second, up to 6 requests per second in bursts. Some endpoints may have custom rate limits.
>
>PRIVATE ENDPOINTS
>
>We throttle private endpoints by profile ID: 5 requests per second, up to 10 requests per second in bursts. Some endpoints may have custom rate limits.

***The package has a mechanism to handle and delay/repeat the request if limits are reached.***

***This parameter is active by default but can be disabled if necessary.***

Example 1 :

```php
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;

$config = CoinbaseFacade::createDefaultCoinbaseConfig(
    'API_ENDPOINT',
    'API_KEY',
    'API_SECRET',
    'API_PASSPHRASE'
);

$config->setManageRateLimits(false); // pass false here to disable rate limit managing

$api = CoinbaseFacade::createCoinbaseApi($config);
```
Example 2 :

```php
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;

$api = CoinbaseFacade::createCoinbaseApiFromYaml('path/to/config.yaml');
```
Config file :

```yaml
params: 
    endpoint: '${API_ENDPOINT}'
    key: '${API_KEY}'
    secret: '${API_SECRET}'
    passphrase: '${API_PASSPHRASE}'

manage_rate_limits: false # pass false here to disable rate limit managing
```
## CoinbaseFacade other methods list

### Market order

```php
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;
use MockingMagician\CoinbaseProSdk\Functional\Build\MarketOrderToPlace;

$marketOrder = CoinbaseFacade::createMarketOrderToPlace(
    MarketOrderToPlace::SIDE_BUY,
    'BTC-USD',
    0.0001
);
```
More information about [Orders](./feature/orders.md)

### Limit order

```php
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;
use MockingMagician\CoinbaseProSdk\Functional\Build\LimitOrderToPlace;

$limitOrder = CoinbaseFacade::createLimitOrderToPlace(
    LimitOrderToPlace::SIDE_BUY,
    'BTC-USD',
    10000,
    0.0001
);
```
More information about [Orders](./feature/orders.md)

### Pagination

```php
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;

$pagination = CoinbaseFacade::createPagination();
```
More information about [Pagination](./pagination.md)

### Websocket

Websocket is not part of the Coinbase REST api, it is real-time market data updates provided by coinbase.

***It is not necessary to be authenticated*** to take advantage of it, so a method is directly defined in CoinbaseFacade to take advantage of this feature.

```php
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;

$websocket = CoinbaseFacade::createUnauthenticatedWebsocket();
```

***It is also possible to take advantage of it in an authenticated way*** in order to obtain more detailed information about the operations that concern the authenticated user. In this case it is necessary to use the websocket provided with the api.

More information about [Websocket](./feature/websocket.md)
