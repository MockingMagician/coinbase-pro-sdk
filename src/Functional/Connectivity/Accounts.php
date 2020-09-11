<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\AccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\AccountData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\AccountHistoryEventData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\HoldData;

class Accounts extends AbstractRequestManagerAware implements AccountsInterface
{
    public function listRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/accounts')->signAndSend();
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
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/accounts/%s/ledger', $id), [], null, $pagination)->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function getAccountHistory(string $id, ?PaginationInterface $pagination = null): array
    {
        return AccountHistoryEventData::createCollectionFromJson($this->getAccountHistoryRaw($id, $pagination));
    }

    public function getHoldsRaw(string $id, ?PaginationInterface $pagination = null)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/accounts/%s/holds', $id), [], null, $pagination)->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function getHolds(string $id, ?PaginationInterface $pagination = null): array
    {
        return HoldData::createCollectionFromJson($this->getHoldsRaw($id, $pagination));
    }
}
