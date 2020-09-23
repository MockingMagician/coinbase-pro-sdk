<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ProfilesInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProfileDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ProfileData;

class Profiles extends AbstractRequestManagerAware implements ProfilesInterface
{
    public function listProfilesRaw(bool $active)
    {
        $query = ['active' => $active];

        return $this->getRequestManager()->prepareRequest('GET', '/profiles', $query)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function listProfiles(bool $active): array
    {
        return ProfileData::createCollectionFromJson($this->listProfilesRaw($active));
    }

    public function getProfileRaw(string $profileId)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/profiles/%s', $profileId))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getProfile(string $profileId): ProfileDataInterface
    {
        return ProfileData::createFromJson($this->getProfileRaw($profileId));
    }

    public function createProfileTransferRaw(string $fromProfileId, string $toProfileId, string $currency, float $amount)
    {
        $body = [
            'from' => $fromProfileId,
            'to' => $toProfileId,
            'currency' => $currency,
            'amount' => $amount,
        ];

        return $this->getRequestManager()->prepareRequest('POST', '/profiles/transfer', [], json_encode($body))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function createProfileTransfer(string $fromProfileId, string $toProfileId, string $currency, float $amount): bool
    {
        return 'OK' === $this->createProfileTransferRaw($fromProfileId, $toProfileId, $currency, $amount);
    }
}
