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

    public function activateAccounts(bool $set): ConnectivityConfigInterface
    {
        $this->accounts = $set;

        return $this;
    }

    public function isAccountsActivate(): bool
    {
        return $this->accounts;
    }

    public function activateOrders(bool $set): ConnectivityConfigInterface
    {
        $this->orders = $set;

        return $this;
    }

    public function isOrdersActivate(): bool
    {
        return $this->orders;
    }

    public function activateFills(bool $set): ConnectivityConfigInterface
    {
        $this->fills = $set;

        return $this;
    }

    public function isFillsActivate(): bool
    {
        return $this->fills;
    }

    public function activateLimits(bool $set): ConnectivityConfigInterface
    {
        $this->limits = $set;

        return $this;
    }

    public function isLimitsActivate(): bool
    {
        return $this->limits;
    }

    public function activateDeposits(bool $set): ConnectivityConfigInterface
    {
        $this->deposits = $set;

        return $this;
    }

    public function isDepositsActivate(): bool
    {
        return $this->deposits;
    }

    public function activateWithdrawals(bool $set): ConnectivityConfigInterface
    {
        $this->withdrawals = $set;

        return $this;
    }

    public function isWithdrawalsActivate(): bool
    {
        return $this->withdrawals;
    }

    public function activateStablecoinConversions(bool $set): ConnectivityConfigInterface
    {
        $this->stablecoinConversions = $set;

        return $this;
    }

    public function isStablecoinConversionsActivate(): bool
    {
        return $this->stablecoinConversions;
    }

    public function activatePaymentMethods(bool $set): ConnectivityConfigInterface
    {
        $this->paymentMethods = $set;

        return $this;
    }

    public function isPaymentMethodsActivate(): bool
    {
        return $this->paymentMethods;
    }

    public function activateCoinbaseAccounts(bool $set): ConnectivityConfigInterface
    {
        $this->coinbaseAccounts = $set;

        return $this;
    }

    public function isCoinbaseAccountsActivate(): bool
    {
        return $this->coinbaseAccounts;
    }

    public function activateFees(bool $set): ConnectivityConfigInterface
    {
        $this->fees = $set;

        return $this;
    }

    public function isFeesActivate(): bool
    {
        return $this->fees;
    }

    public function activateReports(bool $set): ConnectivityConfigInterface
    {
        $this->reports = $set;

        return $this;
    }

    public function isReportsActivate(): bool
    {
        return $this->reports;
    }

    public function activateProfiles(bool $set): ConnectivityConfigInterface
    {
        $this->profiles = $set;

        return $this;
    }

    public function isProfilesActivate(): bool
    {
        return $this->profiles;
    }

    public function activateUserAccount(bool $set): ConnectivityConfigInterface
    {
        $this->userAccount = $set;

        return $this;
    }

    public function isUserAccountActivate(): bool
    {
        return $this->userAccount;
    }

    public function activateMargin(bool $set): ConnectivityConfigInterface
    {
        $this->margin = $set;

        return $this;
    }

    public function isMarginActivate(): bool
    {
        return $this->margin;
    }

    public function activateOracle(bool $set): ConnectivityConfigInterface
    {
        $this->oracle = $set;

        return $this;
    }

    public function isOracleActivate(): bool
    {
        return $this->oracle;
    }

    public function activateProducts(bool $set): ConnectivityConfigInterface
    {
        $this->products = $set;

        return $this;
    }

    public function isProductsActivate(): bool
    {
        return $this->products;
    }

    public function activateCurrencies(bool $set): ConnectivityConfigInterface
    {
        $this->currencies = $set;

        return $this;
    }

    public function isCurrenciesActivate(): bool
    {
        return $this->currencies;
    }

    public function activateTime(bool $set): ConnectivityConfigInterface
    {
        $this->time = $set;

        return $this;
    }

    public function isTimeActivate(): bool
    {
        return $this->time;
    }
}
