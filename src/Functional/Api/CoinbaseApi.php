<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Api;

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\AccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\CoinbaseAccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\CurrenciesInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\DepositsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\FeesInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\FillsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\LimitsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\MarginInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\OracleInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\OrdersInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\PaymentMethodsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ProductsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ProfilesInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ReportsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\StableCoinConversionsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\WithdrawalsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestFactoryInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\WebsocketInterface;
use MockingMagician\CoinbaseProSdk\Functional\Api\Config\CoinbaseConfig;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\CoinbaseAccounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Currencies;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Deposits;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Fees;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Fills;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Limits;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Margin;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\MarginApiReadyCheckDecorator;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Oracle;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Orders;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\PaymentMethods;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Products;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Profiles;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Reports;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\StableCoinConversions;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Time;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Withdrawals;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Websocket;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\WebsocketRunner;

class CoinbaseApi implements ApiInterface
{
    const FUNCTIONALITY_NOT_LOADED = 'The %s functionality was not loaded when building the ApiConnectivity object. Please recreate an object with this feature to be able to use it.';

    /**
     * @var null|AccountsInterface
     */
    private $accounts;
    /**
     * @var null|CoinbaseAccountsInterface
     */
    private $coinbaseAccounts;
    /**
     * @var null|CurrenciesInterface
     */
    private $currencies;
    /**
     * @var null|DepositsInterface
     */
    private $deposits;
    /**
     * @var null|FeesInterface
     */
    private $fees;
    /**
     * @var null|FillsInterface
     */
    private $fills;
    /**
     * @var null|LimitsInterface
     */
    private $limits;
    /**
     * @var null|MarginInterface
     */
    private $margin;
    /**
     * @var null|OracleInterface
     */
    private $oracle;
    /**
     * @var null|OrdersInterface
     */
    private $orders;
    /**
     * @var null|PaymentMethodsInterface
     */
    private $paymentMethods;
    /**
     * @var null|ProductsInterface
     */
    private $products;
    /**
     * @var null|ProfilesInterface
     */
    private $profiles;
    /**
     * @var null|ReportsInterface
     */
    private $reports;
    /**
     * @var null|StableCoinConversionsInterface
     */
    private $stableCoinConversions;
    /**
     * @var null|TimeInterface
     */
    private $time;
    /**
     * @var null|WithdrawalsInterface
     */
    private $withdrawals;
    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;
    /**
     * @var Websocket
     */
    private $websocket;
    /**
     * @var array
     */
    private $config = [];

    public function __construct(CoinbaseConfig $config)
    {
        $this->config['isManageRateLimits'] = $config->isManageRateLimits();
        $this->config['isUseCoinbaseRemoteTime'] = $config->isUseCoinbaseRemoteTime();
        $this->config['isUseSecurityLayerForParams'] = $config->isUseSecurityLayerForParams();

        $this->requestFactory = $config->getBuildRequestFactory();

        $this->accounts = $config->getConnectivityConfig()->isAccountsActivate() ? new Accounts($this->requestFactory) : null;
        $this->coinbaseAccounts = $config->getConnectivityConfig()->isCoinbaseAccountsActivate() ? new CoinbaseAccounts($this->requestFactory) : null;
        $this->currencies = $config->getConnectivityConfig()->isCoinbaseAccountsActivate() ? new Currencies($this->requestFactory) : null;
        $this->deposits = $config->getConnectivityConfig()->isDepositsActivate() ? new Deposits($this->requestFactory) : null;
        $this->fees = $config->getConnectivityConfig()->isFeesActivate() ? new Fees($this->requestFactory) : null;
        $this->fills = $config->getConnectivityConfig()->isFillsActivate() ? new Fills($this->requestFactory) : null;
        $this->limits = $config->getConnectivityConfig()->isLimitsActivate() ? new Limits($this->requestFactory) : null;
        $this->margin = $config->getConnectivityConfig()->isMarginActivate() ? new MarginApiReadyCheckDecorator(new Margin($this->requestFactory)) : null;
        $this->oracle = $config->getConnectivityConfig()->isOracleActivate() ? new Oracle($this->requestFactory) : null;
        $this->orders = $config->getConnectivityConfig()->isOrdersActivate() ? new Orders($this->requestFactory) : null;
        $this->paymentMethods = $config->getConnectivityConfig()->isPaymentMethodsActivate() ? new PaymentMethods($this->requestFactory) : null;
        $this->products = $config->getConnectivityConfig()->isProductsActivate() ? new Products($this->requestFactory) : null;
        $this->profiles = $config->getConnectivityConfig()->isProfilesActivate() ? new Profiles($this->requestFactory) : null;
        $this->reports = $config->getConnectivityConfig()->isReportsActivate() ? new Reports($this->requestFactory) : null;
        $this->stableCoinConversions = $config->getConnectivityConfig()->isStablecoinConversionsActivate() ? new StableCoinConversions($this->requestFactory) : null;
        $this->time = $config->getConnectivityConfig()->isTimeActivate() ? new Time($this->requestFactory) : null;
        $this->withdrawals = $config->getConnectivityConfig()->isWithdrawalsActivate() ? new Withdrawals($this->requestFactory) : null;

        $this->websocket = new Websocket(new WebsocketRunner(), $this, $config->isUseCoinbaseRemoteTime() ? new Time($this->requestFactory) : null);
    }

    public function __serialize()
    {
        return [
            'endpoint' => $this->requestFactory->getParams()->getEndPoint(),
            'key' => $this->requestFactory->getParams()->getKey(),
            'secret' => $this->requestFactory->getParams()->getSecret(),
            'passphrase' => $this->requestFactory->getParams()->getPassphrase(),
            'endpoints' => [
                'accounts' => (bool) $this->accounts,
                'coinbaseAccounts' => (bool) $this->coinbaseAccounts,
                'currencies' => (bool) $this->currencies,
                'deposits' => (bool) $this->deposits,
                'fees' => (bool) $this->fees,
                'fills' => (bool) $this->fills,
                'limits' => (bool) $this->limits,
                'margin' => (bool) $this->margin,
                'oracle' => (bool) $this->oracle,
                'orders' => (bool) $this->orders,
                'paymentMethods' => (bool) $this->paymentMethods,
                'products' => (bool) $this->products,
                'profiles' => (bool) $this->profiles,
                'reports' => (bool) $this->reports,
                'stableCoinConversions' => (bool) $this->stableCoinConversions,
                'time' => (bool) $this->time,
                'withdrawals' => (bool) $this->withdrawals,
            ],
            'config' => [
                'isManageRateLimits' => $this->config['isManageRateLimits'],
                'isUseCoinbaseRemoteTime' => $this->config['isUseCoinbaseRemoteTime'],
                'isUseSecurityLayerForParams' => $this->config['isUseSecurityLayerForParams'],
            ],
        ];
    }

    public function __unserialize(array $data)
    {
        $config = CoinbaseConfig::createDefault(
            $data['endpoint'],
            $data['key'],
            $data['secret'],
            $data['passphrase']
        );

        $config->setManageRateLimits($data['config']['isManageRateLimits']);
        $config->setUseCoinbaseRemoteTime($data['config']['isUseCoinbaseRemoteTime']);
        $config->setUseSecurityLayerForParams($data['config']['isUseSecurityLayerForParams']);

        $this->config = $data['config'];

        $this->requestFactory = $config->getBuildRequestFactory();

        $this->accounts = $data['endpoints']['accounts'] ? new Accounts($this->requestFactory) : null;
        $this->coinbaseAccounts = $data['endpoints']['coinbaseAccounts'] ? new CoinbaseAccounts($this->requestFactory) : null;
        $this->currencies = $data['endpoints']['currencies'] ? new Currencies($this->requestFactory) : null;
        $this->deposits = $data['endpoints']['deposits'] ? new Deposits($this->requestFactory) : null;
        $this->fees = $data['endpoints']['fees'] ? new Fees($this->requestFactory) : null;
        $this->fills = $data['endpoints']['fills'] ? new Fills($this->requestFactory) : null;
        $this->limits = $data['endpoints']['limits'] ? new Limits($this->requestFactory) : null;
        $this->margin = $data['endpoints']['margin'] ? new MarginApiReadyCheckDecorator(new Margin($this->requestFactory)) : null;
        $this->oracle = $data['endpoints']['oracle'] ? new Oracle($this->requestFactory) : null;
        $this->orders = $data['endpoints']['orders'] ? new Orders($this->requestFactory) : null;
        $this->paymentMethods = $data['endpoints']['paymentMethods'] ? new PaymentMethods($this->requestFactory) : null;
        $this->products = $data['endpoints']['products'] ? new Products($this->requestFactory) : null;
        $this->profiles = $data['endpoints']['profiles'] ? new Profiles($this->requestFactory) : null;
        $this->reports = $data['endpoints']['reports'] ? new Reports($this->requestFactory) : null;
        $this->stableCoinConversions = $data['endpoints']['stableCoinConversions'] ? new StableCoinConversions($this->requestFactory) : null;
        $this->time = $data['endpoints']['time'] ? new Time($this->requestFactory) : null;
        $this->withdrawals = $data['endpoints']['withdrawals'] ? new Withdrawals($this->requestFactory) : null;

        $this->websocket = new Websocket(new WebsocketRunner(), $this, $data['config']['isUseCoinbaseRemoteTime'] ? new Time($this->requestFactory) : null);
    }

    public function accounts(): AccountsInterface
    {
        if (!$this->accounts) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'accounts'));
        }

        return $this->accounts;
    }

    public function orders(): OrdersInterface
    {
        if (!$this->orders) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'orders'));
        }

        return $this->orders;
    }

    public function fills(): FillsInterface
    {
        if (!$this->fills) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'fills'));
        }

        return $this->fills;
    }

    public function limits(): LimitsInterface
    {
        if (!$this->limits) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'limits'));
        }

        return $this->limits;
    }

    public function deposits(): DepositsInterface
    {
        if (!$this->deposits) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'deposits'));
        }

        return $this->deposits;
    }

    public function withdrawals(): WithdrawalsInterface
    {
        if (!$this->withdrawals) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'withdrawals'));
        }

        return $this->withdrawals;
    }

    public function stablecoinConversions(): StableCoinConversionsInterface
    {
        if (!$this->stableCoinConversions) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'stableCoinConversions'));
        }

        return $this->stableCoinConversions;
    }

    public function paymentMethods(): PaymentMethodsInterface
    {
        if (!$this->paymentMethods) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'paymentMethods'));
        }

        return $this->paymentMethods;
    }

    public function coinbaseAccounts(): CoinbaseAccountsInterface
    {
        if (!$this->coinbaseAccounts) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'coinbaseAccounts'));
        }

        return $this->coinbaseAccounts;
    }

    public function fees(): FeesInterface
    {
        if (!$this->fees) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'fees'));
        }

        return $this->fees;
    }

    public function reports(): ReportsInterface
    {
        if (!$this->reports) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'reports'));
        }

        return $this->reports;
    }

    public function profiles(): ProfilesInterface
    {
        if (!$this->profiles) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'profiles'));
        }

        return $this->profiles;
    }

    public function margin(): MarginInterface
    {
        if (!$this->margin) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'margin'));
        }

        return $this->margin;
    }

    public function oracle(): OracleInterface
    {
        if (!$this->oracle) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'oracle'));
        }

        return $this->oracle;
    }

    public function products(): ProductsInterface
    {
        if (!$this->products) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'products'));
        }

        return $this->products;
    }

    public function currencies(): CurrenciesInterface
    {
        if (!$this->currencies) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'currencies'));
        }

        return $this->currencies;
    }

    public function time(): TimeInterface
    {
        if (!$this->time) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'time'));
        }

        return $this->time;
    }

    public function websocket(): WebsocketInterface
    {
        return $this->websocket;
    }

    public function getRequestFactory(): RequestFactoryInterface
    {
        return $this->requestFactory;
    }
}
