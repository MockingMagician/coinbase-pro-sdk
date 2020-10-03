<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Api\Config;

interface ConnectivityConfigInterface
{
    public function setAccounts(bool $set): ConnectivityConfigInterface;

    public function getAccounts(): bool;

    public function setOrders(bool $set): ConnectivityConfigInterface;

    public function getOrders(): bool;

    public function setFills(bool $set): ConnectivityConfigInterface;

    public function getFills(): bool;

    public function setLimits(bool $set): ConnectivityConfigInterface;

    public function getLimits(): bool;

    public function setDeposits(bool $set): ConnectivityConfigInterface;

    public function getDeposits(): bool;

    public function setWithdrawals(bool $set): ConnectivityConfigInterface;

    public function getWithdrawals(): bool;

    public function setStablecoinConversions(bool $set): ConnectivityConfigInterface;

    public function getStablecoinConversions(): bool;

    public function setPaymentMethods(bool $set): ConnectivityConfigInterface;

    public function getPaymentMethods(): bool;

    public function setCoinbaseAccounts(bool $set): ConnectivityConfigInterface;

    public function getCoinbaseAccounts(): bool;

    public function setFees(bool $set): ConnectivityConfigInterface;

    public function getFees(): bool;

    public function setReports(bool $set): ConnectivityConfigInterface;

    public function getReports(): bool;

    public function setProfiles(bool $set): ConnectivityConfigInterface;

    public function getProfiles(): bool;

    public function setUserAccount(bool $set): ConnectivityConfigInterface;

    public function getUserAccount(): bool;

    public function setMargin(bool $set): ConnectivityConfigInterface;

    public function getMargin(): bool;

    public function setOracle(bool $set): ConnectivityConfigInterface;

    public function getOracle(): bool;

    public function setProducts(bool $set): ConnectivityConfigInterface;

    public function getProducts(): bool;

    public function setCurrencies(bool $set): ConnectivityConfigInterface;

    public function getCurrencies(): bool;

    public function setTime(bool $set): ConnectivityConfigInterface;

    public function getTime(): bool;
}
