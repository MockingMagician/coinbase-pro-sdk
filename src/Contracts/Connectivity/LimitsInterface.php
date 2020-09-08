<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\LimitsDataInterface;

interface LimitsInterface
{
    /**
     * Limits
     * Get Current Exchange Limits
     *
     * HTTP REQUEST
     * GET /users/self/exchange-limits
     * This request will return information on your payment method transfer limits, as well as buy/sell limits per currency.
     */
    public function getCurrentExchangeLimits(): LimitsDataInterface;
}
