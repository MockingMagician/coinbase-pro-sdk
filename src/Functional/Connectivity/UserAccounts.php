<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\UserAccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\VolumeDataInterface;

class UserAccounts extends AbstractRequestManagerAware implements UserAccountsInterface
{
    public function getTrailingVolumeRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/users/self/trailing-volume')->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function getTrailingVolume(): array
    {
        // TODO: Implement getTrailingVolume() method.
    }
}
