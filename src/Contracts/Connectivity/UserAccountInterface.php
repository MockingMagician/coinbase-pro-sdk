<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\VolumeDataInterface;

interface UserAccountInterface
{
    /**
     * Trailing Volume.
     *
     * HTTP REQUEST
     * GET /users/self/trailing-volume
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * This request will return your 30-day trailing volume for all products of the API key's profile.
     * This is a cached value that's calculated every day at midnight UTC.
     *
     * @return VolumeDataInterface[]
     */
    public function getTrailingVolume(): array;
}
