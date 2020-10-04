<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\CoinbaseAccountsInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CoinbaseAccountData;

class CoinbaseAccounts extends AbstractRequestFactoryAware implements CoinbaseAccountsInterface
{
    public function listCoinbaseAccountsRaw(): string
    {
        return $this->getRequestFactory()->createRequest('GET', '/coinbase-accounts')->send();
    }

    /**
     * {@inheritdoc}
     */
    public function listCoinbaseAccounts(): array
    {
        return CoinbaseAccountData::createCollectionFromJson($this->listCoinbaseAccountsRaw());
    }
}
