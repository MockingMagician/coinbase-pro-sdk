<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


interface ConnectivityInterface
{
    public function getPortfolio(): PortfolioInterface;
    public function getAccounts(): AccountsInterface;
}
