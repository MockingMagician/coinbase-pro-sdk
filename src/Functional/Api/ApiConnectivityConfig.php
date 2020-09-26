<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Api;


use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiConnectivityConfigInterface;

class ApiConnectivityConfig implements ApiConnectivityConfigInterface
{
    /**
     * @var bool
     */
    private $accounts = true;
    /**
     * @var bool
     */
    private $orders = true;
    /**
     * @var bool
     */
    private $fills = true;
    /**
     * @var bool
     */
    private $limits = true;
    /**
     * @var bool
     */
    private $deposits = true;
    /**
     * @var bool
     */
    private $withdrawals = true;
    /**
     * @var bool
     */
    private $stablecoinConversions = true;
    /**
     * @var bool
     */
    private $paymentMethods = true;
    /**
     * @var bool
     */
    private $coinbaseAccounts = true;
    /**
     * @var bool
     */
    private $fees = true;
    /**
     * @var bool
     */
    private $reports = true;
    /**
     * @var bool
     */
    private $profiles = true;
    /**
     * @var bool
     */
    private $userAccount = true;
    /**
     * @var bool
     */
    private $margin = true;
    /**
     * @var bool
     */
    private $oracle = true;
    /**
     * @var bool
     */
    private $products = true;
    /**
     * @var bool
     */
    private $currencies = true;
    /**
     * @var bool
     */
    private $time = true;

    public function setAccounts(bool $set): ApiConnectivityConfigInterface
    {
        $this->accounts = $set;
        return $this;
    }

    public function getAccounts(): bool
    {
        return $this->accounts;
    }

    public function setOrders(bool $set): ApiConnectivityConfigInterface
    {
        $this->orders = $set;
        return $this;
    }

    public function getOrders(): bool
    {
        return $this->orders;
    }

    public function setFills(bool $set): ApiConnectivityConfigInterface
    {
        $this->fills = $set;
        return $this;
    }

    public function getFills(): bool
    {
        return $this->fills;
    }

    public function setLimits(bool $set): ApiConnectivityConfigInterface
    {
        $this->limits = $set;
        return $this;
    }

    public function getLimits(): bool
    {
        return $this->limits;
    }

    public function setDeposits(bool $set): ApiConnectivityConfigInterface
    {
        $this->deposits = $set;
        return $this;
    }

    public function getDeposits(): bool
    {
        return $this->deposits;
    }

    public function setWithdrawals(bool $set): ApiConnectivityConfigInterface
    {
        $this->withdrawals = $set;
        return $this;
    }

    public function getWithdrawals(): bool
    {
        return $this->withdrawals;
    }

    public function setStablecoinConversions(bool $set): ApiConnectivityConfigInterface
    {
        $this->stablecoinConversions = $set;
        return $this;
    }

    public function getStablecoinConversions(): bool
    {
        return $this->stablecoinConversions;
    }

    public function setPaymentMethods(bool $set): ApiConnectivityConfigInterface
    {
        $this->paymentMethods = $set;
        return $this;
    }

    public function getPaymentMethods(): bool
    {
        return $this->paymentMethods;
    }

    public function setCoinbaseAccounts(bool $set): ApiConnectivityConfigInterface
    {
        $this->coinbaseAccounts = $set;
        return $this;
    }

    public function getCoinbaseAccounts(): bool
    {
        return $this->coinbaseAccounts;
    }

    public function setFees(bool $set): ApiConnectivityConfigInterface
    {
        $this->fees = $set;
        return $this;
    }

    public function getFees(): bool
    {
        return $this->fees;
    }

    public function setReports(bool $set): ApiConnectivityConfigInterface
    {
        $this->reports = $set;
        return $this;
    }

    public function getReports(): bool
    {
        return $this->reports;
    }

    public function setProfiles(bool $set): ApiConnectivityConfigInterface
    {
        $this->profiles = $set;
        return $this;
    }

    public function getProfiles(): bool
    {
        return $this->profiles;
    }

    public function setUserAccount(bool $set): ApiConnectivityConfigInterface
    {
        $this->userAccount = $set;
        return $this;
    }

    public function getUserAccount(): bool
    {
        return $this->userAccount;
    }

    public function setMargin(bool $set): ApiConnectivityConfigInterface
    {
        $this->margin = $set;
        return $this;
    }

    public function getMargin(): bool
    {
        return $this->margin;
    }

    public function setOracle(bool $set): ApiConnectivityConfigInterface
    {
        $this->oracle = $set;
        return $this;
    }

    public function getOracle(): bool
    {
        return $this->oracle;
    }

    public function setProducts(bool $set): ApiConnectivityConfigInterface
    {
        $this->products = $set;
        return $this;
    }

    public function getProducts(): bool
    {
        return $this->products;
    }

    public function setCurrencies(bool $set): ApiConnectivityConfigInterface
    {
        $this->currencies = $set;
        return $this;
    }

    public function getCurrencies(): bool
    {
        return $this->currencies;
    }

    public function setTime(bool $set): ApiConnectivityConfigInterface
    {
        $this->time = $set;
        return $this;
    }

    public function getTime(): bool
    {
        return $this->time;
    }
}
