<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\CoinbaseAccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\CoinbaseDepositAddressDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CoinbaseAccountData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CoinbaseDepositAddressData;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

class CoinbaseAccounts extends AbstractConnectivity implements CoinbaseAccountsInterface
{
    public function listCoinbaseAccountsRaw(): string
    {
        return $this->getRequestFactory()->createRequest('GET', '/coinbase-accounts')->send();
    }

    /**
     * {@inheritdoc}
     */
    public function list(): array
    {
        return CoinbaseAccountData::createCollectionFromJson($this->listCoinbaseAccountsRaw());
    }

    public function generateCryptoAddressRaw(string $accountId): string
    {
        return $this->getRequestFactory()->createRequest('POST', sprintf('/coinbase-accounts/%s/addresses', $accountId))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function generateCryptoAddress(string $accountId): CoinbaseDepositAddressDataInterface
    {
        return CoinbaseDepositAddressData::createFromArray(Json::decode($this->generateCryptoAddressRaw($accountId), true));
    }
}
