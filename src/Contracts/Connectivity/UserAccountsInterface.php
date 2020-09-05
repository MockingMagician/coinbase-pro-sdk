<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\VolumeDataInterface;

interface UserAccountsInterface
{
    /**
     * Trailing Volume
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
