<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\AccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\AccountData;

class Accounts extends AbstractConnectivity implements AccountsInterface
{
    public function listRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/accounts', null)->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function list(): array
    {
        return AccountData::createCollectionFromJson($this->listRaw());
    }

    /**
     * @inheritDoc
     */
    public function getAccount(string $id): AccountDataInterface
    {
        // TODO: Implement getAccount() method.
    }

    /**
     * @inheritDoc
     */
    public function getAccountHistory(string $id, ?PaginationInterface $pagination = null): array
    {
        // TODO: Implement getAccountHistory() method.
    }

    /**
     * @inheritDoc
     */
    public function getHolds(): array
    {
        // TODO: Implement getHolds() method.
    }
}
