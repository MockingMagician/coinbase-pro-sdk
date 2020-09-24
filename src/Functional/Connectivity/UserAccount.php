<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\UserAccountInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\VolumeData;

class UserAccount extends AbstractRequestManagerAware implements UserAccountInterface
{
    public function getTrailingVolumeRaw()
    {
        return $this->getRequestManager()->createRequest('GET', '/users/self/trailing-volume')->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getTrailingVolume(): array
    {
        return VolumeData::createCollectionFromJson($this->getTrailingVolumeRaw());
    }
}
