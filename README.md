# This package is designed to communicate easily with the Coinbase Pro API in PHP.

***Please take the time to read the documentation below carefully.***

## How do I access the features?

### 1 : Create an ApiConnectivity object.

#### 1.1 : Full API access

```php

use MockingMagician\CoinbaseProSdk\Functional\ApiFactory;

$api = ApiFactory::createFull(
    'API_ENDPOINT',
    'API_KEY',
    'API_SECRET',
    'API_PASSPHRASE'
);

```

#### 1.2 : Customize API access

```php

use MockingMagician\CoinbaseProSdk\Functional\ApiFactory;

$api = ApiFactory::create(
    'API_ENDPOINT',
    'API_KEY',
    'API_SECRET',
    'API_PASSPHRASE',
    true, // activate or deactivate Accounts
    true, // activate or deactivate CoinbaseAccounts
    true, // activate or deactivate Currencies
    true, // activate or deactivate Deposits
    true, // activate or deactivate Fees
    true, // activate or deactivate Fills
    true, // activate or deactivate Limits
    true, // activate or deactivate Margin
    true, // activate or deactivate Oracle
    true, // activate or deactivate Orders
    true, // activate or deactivate PaymentMethods
    true, // activate or deactivate Products
    true, // activate or deactivate Profiles
    true, // activate or deactivate Reports
    true, // activate or deactivate StableCoinConversions
    true, // activate or deactivate Time
    true, // activate or deactivate UserAccounts
    true  // activate or deactivate Withdrawals
);

```

#### 1.3 : Create from config file

```php

use MockingMagician\CoinbaseProSdk\Functional\ApiFactory;

$api = ApiFactory::createFromYamlConfig('path/to/config.yaml');

```

Example of a complete configuration file :

```yaml

connectivity: 
    # endpoint: '${SOME_ENV}' <= formatting as is autoload SOME_ENV if exist 
    endpoint: '${API_ENDPOINT}'
    key: '${API_KEY}'
    secret: '${API_SECRET}'
    passphrase: '${API_PASSPHRASE}'

features:
    accounts: true
    coinbase_accounts: true
    currencies: true
    deposits: true
    fees: true
    fills: true
    limits: true
    margin: true
    oracle: true
    orders: true
    payment_methods: true
    products: true
    profiles: true
    reports: true
    stablecoin_conversions: true
    time: true
    user_accounts: true
    withdrawals: true

remote_time: false

```

Minimal configuration file :

```yaml

connectivity:
    endpoint: '${API_ENDPOINT}'
    key: '${API_KEY}'
    secret: '${API_SECRET}'
    passphrase: '${API_PASSPHRASE}'

features: true

```

#### 1.4 : Time in API request

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

use MockingMagician\CoinbaseProSdk\Functional\ApiFactory;

$api = ApiFactory::createFull(
    'API_ENDPOINT',
    'API_KEY',
    'API_SECRET',
    'API_PASSPHRASE',
    true // pass true here to enable the remote timestamp provided by the remote Coinbase server
);

```

Example 2 :

```php

use MockingMagician\CoinbaseProSdk\Functional\ApiFactory;

$api = ApiFactory::create(
    'API_ENDPOINT',
    'API_KEY',
    'API_SECRET',
    'API_PASSPHRASE',
    true, // activate or deactivate Accounts
    ...
    true, // activate or deactivate Withdrawals
    true  // pass true here to enable the remote timestamp provided by the remote Coinbase server
);

```

Example 3 :

```php

use MockingMagician\CoinbaseProSdk\Functional\ApiFactory;

$api = ApiFactory::createFromYamlConfig('path/to/config.yaml');

```

Config file :

```yaml

connectivity: 
    # endpoint: '${SOME_ENV}' <= formatting as is autoload SOME_ENV if exist 
    endpoint: '${API_ENDPOINT}'
    key: '${API_KEY}'
    secret: '${API_SECRET}'
    passphrase: '${API_PASSPHRASE}'

features: true

remote_time: true # pass true here to enable the remote timestamp provided by the remote Coinbase server

```

### 2 : Using the ApiConnectivity object

***In the rest of the documentation, we will assume that you know how to create an ApiConnectivity object and the variable $api will refer to this object.***

#### 2.1 : List of features 

All features described in the [documentation](https://docs.pro.coinbase.com) are implemented :

- Accounts
- Orders
- Fills
- Limits
- Deposits
- Withdrawals
- Stablecoin Conversions
- Payment Methods
- Coinbase Accounts
- Fees
- Reports
- Profiles
- User Account
- Margin
- Oracle
- Market Data
- Products
- Currencies
- Time

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

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
$api->userAccounts();
$api->margin();
$api->oracle();
$api->products();
$api->currencies();
$api->time();

```

#### 2.2 : Details by category

##### 2.2 : Accounts methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->accounts()->list();
$api->accounts()->getAccount('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->accounts()->getAccountHistory('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->accounts()->getHolds('132fb6ae-456b-4654-b4e0-d681ac05cea1');

```

##### 2.2 : Orders methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->orders()->getOrderById('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->orders()->listOrders();
$api->orders()->cancelOrderById('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->orders()->cancelAllOrders();
$api->orders()->cancelOrderByClientOrderId('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->orders()->getOrderByClientOrderId('132fb6ae-456b-4654-b4e0-d681ac05cea1');

```

***How to place an order ?***

###### 2.2.1 : Place market order

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\MarketOrderToPlace;

/** @var ApiConnectivityInterface $api */

$marketOrder = new MarketOrderToPlace(MarketOrderToPlace::SIDE_BUY, 'BTC-USD', 0.0001);
$api->orders()->placeOrder($marketOrder);

```

###### 2.2.2 : Place limit order

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\LimitOrderToPlace;

/** @var ApiConnectivityInterface $api */

$limitOrder = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 10000, 0.0001);

$api->orders()->placeOrder($limitOrder);

```

###### 2.2.3 : Understanding orders

***For a good understanding of the orders and parameters available for each order, please refer to the Coinbase Pro documentation, as well as the documentation available in the interfaces of this package.***

Example of complex orders :

- Market

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\MarketOrderToPlace;

/** @var ApiConnectivityInterface $api */

$marketOrder = new MarketOrderToPlace(
    MarketOrderToPlace::SIDE_BUY,
    'BTC-USD',
    0.0001, // null if funds is set and "vice versa"
    null, // null if size is set and "vice versa"
    MarketOrderToPlace::SELF_TRADE_PREVENTION_DECREASE_AND_CANCEL, // The self trade prevention flag,
    MarketOrderToPlace::STOP_LOSS, // Direction flag for stop
    1000, // Stop price
    '132fb6ae-456b-4654-b4e0-d681ac05cea1' // A custom id that you defined (UUID format only)
);

$api->orders()->placeOrder($marketOrder);

```

- Limit

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\LimitOrderToPlace;

/** @var ApiConnectivityInterface $api */

$limitOrder = new LimitOrderToPlace(
    LimitOrderToPlace::SIDE_BUY,
    'BTC-USD',
    10000, // Price
    0.0001, // Sice
LimitOrderToPlace::TIME_IN_FORCE_GOOD_TILL_CANCELED, // The TIF flag
    LimitOrderToPlace::CANCEL_AFTER_DAY, // A cancel after time
    true, // Define if post-only or taker allowed, post_only is disabled by default
    LimitOrderToPlace::SELF_TRADE_PREVENTION_DECREASE_AND_CANCEL, // The self trade prevention flag,
    LimitOrderToPlace::STOP_LOSS, // Direction flag for stop
    1000, // Stop price
    '132fb6ae-456b-4654-b4e0-d681ac05cea1' // A custom id that you defined (UUID format only)
);

$api->orders()->placeOrder($limitOrder);

```

##### 2.3 : Fills methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->fills()->listFills();

```

##### 2.4 : Limits methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->limits()->getCurrentExchangeLimits();

```

##### 2.5 : Deposits methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->deposits()->listDeposits();
$api->deposits()->getDeposit('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->deposits()->doDeposit(100, 'USD', '132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->deposits()->doDepositFromCoinbase(100, 'USD', '132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->deposits()->generateCryptoDepositAddress('132fb6ae-456b-4654-b4e0-d681ac05cea1');

```

##### 2.6 : Withdrawals methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->withdrawals()->listWithdrawals();
$api->withdrawals()->getWithdrawal('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->withdrawals()->doWithdraw(100, 'USD', '132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->withdrawals()->doWithdrawToCoinbase(100, 'USD', '132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->withdrawals()->doWithdrawToCryptoAddress(0.1, 'BTC', 'bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq');

```

##### 2.7 : Stablecoin Conversions methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->stablecoinConversions()->createConversion('USD', 'USDC', 100);

```

##### 2.8 : Payment Methods methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->paymentMethods()->listPaymentMethods();

```

##### 2.9 : Coinbase Accounts methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->coinbaseAccounts()->listCoinbaseAccounts();

```

##### 2.10 : Fees methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->fees()->getCurrentFees();

```

##### 2.11 : Reports methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ReportsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

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

##### 2.12 : Profiles methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->profiles()->listProfiles(true /* list active only or not */);
$api->profiles()->getProfile('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->profiles()->createProfileTransfer('132fb6ae-456b-4654-b4e0-d681ac05cea1', '742fb6ae-145f-8954-b4e0-d681ac05cea1', 'USD', 500);

```

##### 2.13 : User Account methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->userAccounts()->getTrailingVolume();

```

##### 2.14 : Margin methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

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

##### 2.15 : Oracle methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->oracle()->getCryptographicallySignedPrices();

```

##### 2.16 : Products methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->products()->getProducts();
$api->products()->get24hrStats('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->products()->getProductTicker('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->products()->getProductOrderBook('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->products()->getTrades('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->products()->getSingleProduct('132fb6ae-456b-4654-b4e0-d681ac05cea1');
$api->products()->getHistoricRates(
    '132fb6ae-456b-4654-b4e0-d681ac05cea1',
    (new DateTime())->modify('-1 year'),
    new DateTime(),
    3600
);

```

##### 2.17 : Currencies methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->currencies()->getCurrencies();

```

##### 2.18 : Time methods

```php

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;

/** @var ApiConnectivityInterface $api */

$api->time()->getTime();

```

