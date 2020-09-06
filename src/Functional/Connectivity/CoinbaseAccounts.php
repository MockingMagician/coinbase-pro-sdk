<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\CoinbaseAccountsInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CoinbaseAccountData;

class CoinbaseAccounts extends AbstractConnectivity implements CoinbaseAccountsInterface
{
    public function listCoinbaseAccountsRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/coinbase-accounts')->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function listCoinbaseAccounts(): array
    {
        return CoinbaseAccountData::createCollectionFromJson($this->listCoinbaseAccountsRaw());
    }
}
