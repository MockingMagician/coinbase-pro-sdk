<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\StableCoinConversionsDataInterface;

interface StableCoinConversionsInterface
{
    /**
     * Stablecoin Conversions
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
     *
     * @param string $fromCurrencyId
     * @param string $toCurrencyId
     * @param float $amount
     * @return StableCoinConversionsDataInterface
     */
    public function convertToStablecoin(string $fromCurrencyId, string $toCurrencyId, float $amount): StableCoinConversionsDataInterface;
}
