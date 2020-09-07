<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\AccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\AccountData;

class Accounts extends AbstractRequestManagerAware implements AccountsInterface
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

    public function getAccountRaw(string $id)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/accounts/%s', $id))->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function getAccount(string $id): AccountDataInterface
    {
        return AccountData::createFromJson($this->getAccountRaw($id));
    }

    public function getAccountHistoryRaw(string $id, ?PaginationInterface $pagination = null)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/accounts/%s/ledger', $id), null, $pagination)->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function getAccountHistory(string $id, ?PaginationInterface $pagination = null): array
    {
        // TODO: Missing data from test api
    }

    public function getHoldsRaw(string $id, ?PaginationInterface $pagination = null)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/accounts/%s/holds', $id), null, $pagination)->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function getHolds(string $id, ?PaginationInterface $pagination = null): array
    {
        // TODO: Missing data from test api
    }
}
