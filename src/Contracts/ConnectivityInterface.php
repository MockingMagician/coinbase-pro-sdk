<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


interface ConnectivityInterface
{
    public function getAccounts(): AccountsInterface;
    public function orders(): OrdersInterface;
    public function fills(): FillsInterface;
    public function limits(): LimitsInterface;
}
