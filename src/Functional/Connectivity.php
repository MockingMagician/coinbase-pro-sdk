<?php


namespace MockingMagician\CoinbaseProSdk\Functional;


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
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\UserAccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\WithdrawalsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\ConnectivityInterface;

class Connectivity implements ConnectivityInterface
{
    /**
     * @var AccountsInterface
     */
    private $accounts;
    /**
     * @var CoinbaseAccountsInterface
     */
    private $coinbaseAccounts;
    /**
     * @var CurrenciesInterface
     */
    private $currencies;
    /**
     * @var DepositsInterface
     */
    private $deposits;
    /**
     * @var FeesInterface
     */
    private $fees;
    /**
     * @var FillsInterface
     */
    private $fills;
    /**
     * @var LimitsInterface
     */
    private $limits;
    /**
     * @var MarginInterface
     */
    private $margin;
    /**
     * @var OracleInterface
     */
    private $oracle;
    /**
     * @var OrdersInterface
     */
    private $orders;
    /**
     * @var PaymentMethodsInterface
     */
    private $paymentMethods;
    /**
     * @var ProductsInterface
     */
    private $products;
    /**
     * @var ProfilesInterface
     */
    private $profiles;
    /**
     * @var ReportsInterface
     */
    private $reports;
    /**
     * @var StableCoinConversionsInterface
     */
    private $stableCoinConversions;
    /**
     * @var TimeInterface
     */
    private $time;
    /**
     * @var UserAccountsInterface
     */
    private $userAccounts;
    /**
     * @var WithdrawalsInterface
     */
    private $withdrawals;

    public function __construct(
        AccountsInterface $accounts,
        CoinbaseAccountsInterface $coinbaseAccounts,
        CurrenciesInterface $currencies,
        DepositsInterface $deposits,
        FeesInterface $fees,
        FillsInterface $fills,
        LimitsInterface $limits,
        MarginInterface $margin,
        OracleInterface $oracle,
        OrdersInterface $orders,
        PaymentMethodsInterface $paymentMethods,
        ProductsInterface $products,
        ProfilesInterface $profiles,
        ReportsInterface $reports,
        StableCoinConversionsInterface $stableCoinConversions,
        TimeInterface $time,
        UserAccountsInterface $userAccounts,
        WithdrawalsInterface $withdrawals
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
        $this->userAccounts = $userAccounts;
        $this->withdrawals = $withdrawals;
    }

    public function accounts(): AccountsInterface
    {
        return $this->accounts;
    }

    public function orders(): OrdersInterface
    {
        return $this->orders;
    }

    public function fills(): FillsInterface
    {
        return $this->fills;
    }

    public function limits(): LimitsInterface
    {
        return $this->limits;
    }

    public function deposits(): DepositsInterface
    {
        return $this->deposits;
    }

    public function withdrawals(): WithdrawalsInterface
    {
        return $this->withdrawals;
    }

    public function stablecoinConversions(): StableCoinConversionsInterface
    {
        return $this->stableCoinConversions;
    }

    public function paymentMethods(): PaymentMethodsInterface
    {
        return $this->paymentMethods;
    }

    public function coinbaseAccounts(): CoinbaseAccountsInterface
    {
        return $this->coinbaseAccounts;
    }

    public function fees(): FeesInterface
    {
        return $this->fees;
    }

    public function reports(): ReportsInterface
    {
        return $this->reports;
    }

    public function profiles(): ProfilesInterface
    {
        return $this->profiles;
    }

    public function userAccounts(): UserAccountsInterface
    {
        return $this->userAccounts;
    }

    public function margin(): MarginInterface
    {
        return $this->margin;
    }

    public function oracle(): OracleInterface
    {
        return $this->oracle;
    }

    public function products(): ProductsInterface
    {
        return $this->products;
    }

    public function currencies(): CurrenciesInterface
    {
        return $this->currencies;
    }

    public function time(): TimeInterface
    {
        return $this->time;
    }
}
