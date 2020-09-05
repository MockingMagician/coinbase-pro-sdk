<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\AccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\DepositsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\FillsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\LimitsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\OrdersInterface;

interface ConnectivityInterface
{
    /*
     * Private
     */
    public function getAccounts(): AccountsInterface;
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
