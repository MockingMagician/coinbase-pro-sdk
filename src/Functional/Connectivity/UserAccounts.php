<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\UserAccountsInterface;

class UserAccounts extends AbstractRequestManagerAware implements UserAccountsInterface
{
    public function getTrailingVolumeRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/users/self/trailing-volume')->signAndSend();
    }

    /**
     * {@inheritdoc}
     */
    public function getTrailingVolume(): array
    {
        // TODO: Implement getTrailingVolume() method.
    }
}
