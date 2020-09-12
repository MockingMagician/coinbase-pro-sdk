<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ProfilesInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProfileDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ProfileData;

class Profiles extends AbstractRequestManagerAware implements ProfilesInterface
{
    public function listProfilesRaw(bool $active)
    {
        $query = ['active' => $active];

        return $this->getRequestManager()->prepareRequest('GET', '/profiles', $query)->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function listProfiles(bool $active): array
    {
        return ProfileData::createCollectionFromJson($this->listProfilesRaw($active));
    }

    public function getProfileRaw(string $profileId)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/profiles/%s', $profileId))->signAndSend();
    }

    /**
     * @inheritDoc
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

        return $this->getRequestManager()->prepareRequest('POST', '/profiles/transfer', [], json_encode($body))->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function createProfileTransfer(string $fromProfileId, string $toProfileId, string $currency, float $amount): bool
    {
        return 'OK' === $this->createProfileTransferRaw($fromProfileId, $toProfileId, $currency, $amount);
    }
}
