<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProfileDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProfileTransferDataInterface;

interface ProfilesInterface
{
    /**
     * List Profiles
     *
     * List your profiles.
     *
     * HTTP REQUEST
     * GET /profiles
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "view" permission and is accessible by any profile's API key.
     *
     * PARAMETERS
     * Param    Description
     * active    Only return active profiles if set true
     *
     * @param bool $active
     * @return ProfileDataInterface[]
     */
    public function listProfiles(bool $active): array;

    /**
     * Get a Profile
     *
     * Get a single profile by profile id.
     *
     * HTTP REQUEST
     * GET /profiles/<profile_id>
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "view" permission and is accessible by any profile's API key.
     *
     * @param string $profileId
     * @return ProfileDataInterface
     */
    public function getProfile(string $profileId): ProfileDataInterface;

    /**
     * Create profile transfer
     *
     * Transfer funds from API key's profile to another user owned profile.
     *
     * HTTP REQUEST
     * POST /profiles/transfer
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "transfer" permission.
     *
     * PARAMETERS
     * Param    Description
     * from    The profile id the API key belongs to and where the funds are sourced
     * to    The target profile id of where funds will be transferred to
     * currency    i.e. BTC or USD
     * amount    Amount of currency to be transferred
     *
     * @param string $fromProfileId
     * @param string $toProfileId
     * @param string $currency
     * @param float $amount
     * @return ProfileTransferDataInterface
     */
    public function createProfileTransfer(
        string $fromProfileId,
        string $toProfileId,
        string $currency,
        float $amount
    ): ProfileTransferDataInterface;
}
