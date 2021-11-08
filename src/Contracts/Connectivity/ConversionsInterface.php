<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\ConversionDataInterface;

interface ConversionsInterface
{
    /**
     * Converts funds from from currency to to currency. Funds are converted on the from account in the profile_id profile.
     *
     * Request : POST /conversions
     *
     * API Key Permissions
     * This endpoint requires the "trade" permission.
     */
    public function convert(string $from, string $to, float $amount, ?string $nonce = null): ConversionDataInterface;

    /**
     * Gets a currency conversion by id (i.e. USD -> USDC).
     *
     * Request : GET /conversions/{conversion_id}
     *
     * API Key Permissions
     * This endpoint requires the "view" or "trade" permission.
     */
    public function getConversion(string $conversionId): ConversionDataInterface;
}
