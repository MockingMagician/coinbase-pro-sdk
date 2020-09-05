<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\FeeDataInterface;

interface FeesInterface
{
    /**
     * Get Current Fees
     *
     * HTTP REQUEST
     * GET /fees
     *
     * This request will return your current maker & taker fee rates, as well as your 30-day trailing volume.
     * Quoted rates are subject to change. More information on fees can found on our support page.
     *
     * @return FeeDataInterface[]
     */
    public function getCurrentFees(): array;
}
