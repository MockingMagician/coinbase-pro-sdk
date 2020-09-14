<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\LimitsDataInterface;

interface LimitsInterface
{
    /**
     * Limits
     * Get Current Exchange Limits.
     *
     * HTTP REQUEST
     * GET /users/self/exchange-limits
     * This request will return information on your payment method transfer limits, as well as buy/sell limits per currency.
     */
    public function getCurrentExchangeLimits(): LimitsDataInterface;
}
