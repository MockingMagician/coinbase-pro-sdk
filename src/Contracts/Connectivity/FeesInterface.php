<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\FeeDataInterface;

interface FeesInterface
{
    /**
     * Get fees rates and 30 days trailing volume.
     *
     * Request : GET /fees
     *
     * API Key Permissions
     * This endpoint requires the "view" permission.
     */
    public function getCurrentFees(): FeeDataInterface;
}
