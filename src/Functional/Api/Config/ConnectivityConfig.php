<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Api\Config;


use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ConnectivityConfigInterface;

class ConnectivityConfig implements ConnectivityConfigInterface
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

    public function setAccounts(bool $set): ConnectivityConfigInterface
    {
        $this->accounts = $set;

        return $this;
    }

    public function getAccounts(): bool
    {
        return $this->accounts;
    }

    public function setOrders(bool $set): ConnectivityConfigInterface
    {
        $this->orders = $set;

        return $this;
    }

    public function getOrders(): bool
    {
        return $this->orders;
    }

    public function setFills(bool $set): ConnectivityConfigInterface
    {
        $this->fills = $set;

        return $this;
    }

    public function getFills(): bool
    {
        return $this->fills;
    }

    public function setLimits(bool $set): ConnectivityConfigInterface
    {
        $this->limits = $set;

        return $this;
    }

    public function getLimits(): bool
    {
        return $this->limits;
    }

    public function setDeposits(bool $set): ConnectivityConfigInterface
    {
        $this->deposits = $set;

        return $this;
    }

    public function getDeposits(): bool
    {
        return $this->deposits;
    }

    public function setWithdrawals(bool $set): ConnectivityConfigInterface
    {
        $this->withdrawals = $set;

        return $this;
    }

    public function getWithdrawals(): bool
    {
        return $this->withdrawals;
    }

    public function setStablecoinConversions(bool $set): ConnectivityConfigInterface
    {
        $this->stablecoinConversions = $set;

        return $this;
    }

    public function getStablecoinConversions(): bool
    {
        return $this->stablecoinConversions;
    }

    public function setPaymentMethods(bool $set): ConnectivityConfigInterface
    {
        $this->paymentMethods = $set;

        return $this;
    }

    public function getPaymentMethods(): bool
    {
        return $this->paymentMethods;
    }

    public function setCoinbaseAccounts(bool $set): ConnectivityConfigInterface
    {
        $this->coinbaseAccounts = $set;

        return $this;
    }

    public function getCoinbaseAccounts(): bool
    {
        return $this->coinbaseAccounts;
    }

    public function setFees(bool $set): ConnectivityConfigInterface
    {
        $this->fees = $set;

        return $this;
    }

    public function getFees(): bool
    {
        return $this->fees;
    }

    public function setReports(bool $set): ConnectivityConfigInterface
    {
        $this->reports = $set;

        return $this;
    }

    public function getReports(): bool
    {
        return $this->reports;
    }

    public function setProfiles(bool $set): ConnectivityConfigInterface
    {
        $this->profiles = $set;

        return $this;
    }

    public function getProfiles(): bool
    {
        return $this->profiles;
    }

    public function setUserAccount(bool $set): ConnectivityConfigInterface
    {
        $this->userAccount = $set;

        return $this;
    }

    public function getUserAccount(): bool
    {
        return $this->userAccount;
    }

    public function setMargin(bool $set): ConnectivityConfigInterface
    {
        $this->margin = $set;

        return $this;
    }

    public function getMargin(): bool
    {
        return $this->margin;
    }

    public function setOracle(bool $set): ConnectivityConfigInterface
    {
        $this->oracle = $set;

        return $this;
    }

    public function getOracle(): bool
    {
        return $this->oracle;
    }

    public function setProducts(bool $set): ConnectivityConfigInterface
    {
        $this->products = $set;

        return $this;
    }

    public function getProducts(): bool
    {
        return $this->products;
    }

    public function setCurrencies(bool $set): ConnectivityConfigInterface
    {
        $this->currencies = $set;

        return $this;
    }

    public function getCurrencies(): bool
    {
        return $this->currencies;
    }

    public function setTime(bool $set): ConnectivityConfigInterface
    {
        $this->time = $set;

        return $this;
    }

    public function getTime(): bool
    {
        return $this->time;
    }
}
