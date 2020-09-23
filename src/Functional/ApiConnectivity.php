<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional;

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;
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
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\UserAccountInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\WithdrawalsInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class ApiConnectivity implements ApiConnectivityInterface
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
     * @var null|UserAccountInterface
     */
    private $userAccount;
    /**
     * @var null|WithdrawalsInterface
     */
    private $withdrawals;

    public function __construct(
        ?AccountsInterface $accounts,
        ?CoinbaseAccountsInterface $coinbaseAccounts,
        ?CurrenciesInterface $currencies,
        ?DepositsInterface $deposits,
        ?FeesInterface $fees,
        ?FillsInterface $fills,
        ?LimitsInterface $limits,
        ?MarginInterface $margin,
        ?OracleInterface $oracle,
        ?OrdersInterface $orders,
        ?PaymentMethodsInterface $paymentMethods,
        ?ProductsInterface $products,
        ?ProfilesInterface $profiles,
        ?ReportsInterface $reports,
        ?StableCoinConversionsInterface $stableCoinConversions,
        ?TimeInterface $time,
        ?UserAccountInterface $userAccount,
        ?WithdrawalsInterface $withdrawals
    ) {
        $this->accounts = $accounts;
        $this->coinbaseAccounts = $coinbaseAccounts;
        $this->currencies = $currencies;
        $this->deposits = $deposits;
        $this->fees = $fees;
        $this->fills = $fills;
        $this->limits = $limits;
        $this->margin = $margin;
        $this->oracle = $oracle;
        $this->orders = $orders;
        $this->paymentMethods = $paymentMethods;
        $this->products = $products;
        $this->profiles = $profiles;
        $this->reports = $reports;
        $this->stableCoinConversions = $stableCoinConversions;
        $this->time = $time;
        $this->userAccount = $userAccount;
        $this->withdrawals = $withdrawals;
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

    public function userAccount(): UserAccountInterface
    {
        if (!$this->userAccount) {
            throw new ApiError(sprintf(self::FUNCTIONALITY_NOT_LOADED, 'userAccounts'));
        }

        return $this->userAccount;
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
}
