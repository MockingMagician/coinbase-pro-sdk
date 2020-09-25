<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Api;


interface ApiConnectivityConfigInterface
{
    public function setAccounts(bool $set): ApiConnectivityConfigInterface;

    public function getAccounts(): bool;

    public function setOrders(bool $set): ApiConnectivityConfigInterface;

    public function getOrders(): bool;

    public function setFills(bool $set): ApiConnectivityConfigInterface;

    public function getFills(): bool;

    public function setLimits(bool $set): ApiConnectivityConfigInterface;

    public function getLimits(): bool;

    public function setDeposits(bool $set): ApiConnectivityConfigInterface;

    public function getDeposits(): bool;

    public function setWithdrawals(bool $set): ApiConnectivityConfigInterface;

    public function getWithdrawals(): bool;

    public function setStablecoinConversions(bool $set): ApiConnectivityConfigInterface;

    public function getStablecoinConversions(): bool;

    public function setPaymentMethods(bool $set): ApiConnectivityConfigInterface;

    public function getPaymentMethods(): bool;

    public function setCoinbaseAccounts(bool $set): ApiConnectivityConfigInterface;

    public function getCoinbaseAccounts(): bool;

    public function setFees(bool $set): ApiConnectivityConfigInterface;

    public function getFees(): bool;

    public function setReports(bool $set): ApiConnectivityConfigInterface;

    public function getReports(): bool;

    public function setProfiles(bool $set): ApiConnectivityConfigInterface;

    public function getProfiles(): bool;

    public function setUserAccount(bool $set): ApiConnectivityConfigInterface;

    public function getUserAccount(): bool;

    public function setMargin(bool $set): ApiConnectivityConfigInterface;

    public function getMargin(): bool;

    public function setOracle(bool $set): ApiConnectivityConfigInterface;

    public function getOracle(): bool;

    public function setProducts(bool $set): ApiConnectivityConfigInterface;

    public function getProducts(): bool;

    public function setCurrencies(bool $set): ApiConnectivityConfigInterface;

    public function getCurrencies(): bool;

    public function setTime(bool $set): ApiConnectivityConfigInterface;

    public function getTime(): bool;
}

