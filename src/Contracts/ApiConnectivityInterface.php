<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


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

interface ApiConnectivityInterface
{
    /*
     * Private
     */
    public function accounts(): AccountsInterface;
    public function orders(): OrdersInterface;
    public function fills(): FillsInterface;
    public function limits(): LimitsInterface;
    public function deposits(): DepositsInterface;
    public function withdrawals(): WithdrawalsInterface;
    public function stablecoinConversions(): StableCoinConversionsInterface;
    public function paymentMethods(): PaymentMethodsInterface;
    public function coinbaseAccounts(): CoinbaseAccountsInterface;
    public function fees(): FeesInterface;
    public function reports(): ReportsInterface;
    public function profiles(): ProfilesInterface;
    public function userAccounts(): UserAccountsInterface;
    public function margin(): MarginInterface;
    public function oracle(): OracleInterface;

    /*
     * Public
     */
    public function products(): ProductsInterface;
    public function currencies(): CurrenciesInterface;
    public function time(): TimeInterface;
}
