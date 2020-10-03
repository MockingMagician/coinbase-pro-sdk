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
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

class Profiles extends AbstractRequestFactoryAware implements ProfilesInterface
{
    public function listProfilesRaw(bool $active): string
    {
        $query = ['active' => $active];

        return $this->getRequestFactory()->createRequest('GET', '/profiles', $query)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function listProfiles(bool $active): array
    {
        return ProfileData::createCollectionFromJson($this->listProfilesRaw($active));
    }

    public function getProfileRaw(string $profileId): string
    {
        return $this->getRequestFactory()->createRequest('GET', sprintf('/profiles/%s', $profileId))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getProfile(string $profileId): ProfileDataInterface
    {
        return ProfileData::createFromJson($this->getProfileRaw($profileId));
    }

    public function createProfileTransferRaw(string $fromProfileId, string $toProfileId, string $currency, float $amount): string
    {
        $body = [
            'from' => $fromProfileId,
            'to' => $toProfileId,
            'currency' => $currency,
            'amount' => $amount,
        ];

        return $this->getRequestFactory()->createRequest('POST', '/profiles/transfer', [], Json::encode($body))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function createProfileTransfer(string $fromProfileId, string $toProfileId, string $currency, float $amount): bool
    {
        return 'OK' === $this->createProfileTransferRaw($fromProfileId, $toProfileId, $currency, $amount);
    }
}
