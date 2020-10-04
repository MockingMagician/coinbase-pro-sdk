<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Api\Config;

interface ConnectivityConfigInterface
{
    public function activateAccounts(bool $set): ConnectivityConfigInterface;

    public function isAccountsActivate(): bool;

    public function activateOrders(bool $set): ConnectivityConfigInterface;

    public function isOrdersActivate(): bool;

    public function activateFills(bool $set): ConnectivityConfigInterface;

    public function isFillsActivate(): bool;

    public function activateLimits(bool $set): ConnectivityConfigInterface;

    public function isLimitsActivate(): bool;

    public function activateDeposits(bool $set): ConnectivityConfigInterface;

    public function isDepositsActivate(): bool;

    public function activateWithdrawals(bool $set): ConnectivityConfigInterface;

    public function isWithdrawalsActivate(): bool;

    public function activateStablecoinConversions(bool $set): ConnectivityConfigInterface;

    public function isStablecoinConversionsActivate(): bool;

    public function activatePaymentMethods(bool $set): ConnectivityConfigInterface;

    public function isPaymentMethodsActivate(): bool;

    public function activateCoinbaseAccounts(bool $set): ConnectivityConfigInterface;

    public function isCoinbaseAccountsActivate(): bool;

    public function activateFees(bool $set): ConnectivityConfigInterface;

    public function isFeesActivate(): bool;

    public function activateReports(bool $set): ConnectivityConfigInterface;

    public function isReportsActivate(): bool;

    public function activateProfiles(bool $set): ConnectivityConfigInterface;

    public function isProfilesActivate(): bool;

    public function activateUserAccount(bool $set): ConnectivityConfigInterface;

    public function isUserAccountActivate(): bool;

    public function activateMargin(bool $set): ConnectivityConfigInterface;

    public function isMarginActivate(): bool;

    public function activateOracle(bool $set): ConnectivityConfigInterface;

    public function isOracleActivate(): bool;

    public function activateProducts(bool $set): ConnectivityConfigInterface;

    public function isProductsActivate(): bool;

    public function activateCurrencies(bool $set): ConnectivityConfigInterface;

    public function isCurrenciesActivate(): bool;

    public function activateTime(bool $set): ConnectivityConfigInterface;

    public function isTimeActivate(): bool;
}
