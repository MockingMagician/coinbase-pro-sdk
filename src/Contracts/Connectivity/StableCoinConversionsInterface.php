<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\StableCoinConversionsDataInterface;

interface StableCoinConversionsInterface
{
    /**
     * Stablecoin Conversions.
     *
     * Create Conversion
     *
     * HTTP REQUEST
     * POST /conversions
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "trade" permission.
     *
     * PARAMETERS
     * Param    Description
     * from    A valid currency id
     * to    A valid currency id
     * amount    Amount of from to convert to to
     *
     * RESPONSE
     * A successful conversion will be assigned a conversion id.
     * The corresponding ledger entries for a conversion will reference this conversion id.
     */
    public function createConversion(string $fromCurrencyId, string $toCurrencyId, float $amount): StableCoinConversionsDataInterface;
}
