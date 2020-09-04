<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


interface PortfolioInterface
{
    public function orders(): OrdersInterface;
}
