<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProfileDataInterface;

interface ProfilesInterface
{
    /**
     * List Profiles.
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
     * @return ProfileDataInterface[]
     */
    public function listProfiles(bool $active): array;

    /**
     * Get a Profile.
     *
     * Get a single profile by profile id.
     *
     * HTTP REQUEST
     * GET /profiles/<profile_id>
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "view" permission and is accessible by any profile's API key.
     */
    public function getProfile(string $profileId): ProfileDataInterface;

    /**
     * Create profile transfer.
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
     */
    public function createProfileTransfer(
        string $fromProfileId,
        string $toProfileId,
        string $currency,
        float $amount
    ): bool;
}
