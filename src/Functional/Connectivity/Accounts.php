<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\AccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\AccountData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\AccountHistoryEventData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\HoldData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TransferData;
use MockingMagician\CoinbaseProSdk\Functional\Enum\TransferTypeEnum;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

class Accounts extends AbstractConnectivity implements AccountsInterface
{
    public function listRaw(): string
    {
        return $this->getRequestFactory()->createRequest('GET', '/accounts')->send();
    }

    /**
     * {@inheritdoc}
     */
    public function list(): array
    {
        return AccountData::createCollectionFromJson($this->listRaw());
    }

    public function getAccountRaw(string $id): string
    {
        return $this->getRequestFactory()->createRequest('GET', sprintf('/accounts/%s', $id))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getAccount(string $accountId): AccountDataInterface
    {
        return AccountData::createFromJson($this->getAccountRaw($accountId));
    }

    public function getAccountLedgerRaw(
        string $accountId,
        ?PaginationInterface $pagination = null,
        ?DateTimeInterface $startDate = null,
        ?DateTimeInterface $endDate = null
    ): string {
        $query = [];
        if ($startDate) {
            $query['start_date'] = $startDate;
        }
        if ($endDate) {
            $query['end_date'] = $endDate;
        }

        return $this->getRequestFactory()
            ->createRequest(
                'GET',
                sprintf('/accounts/%s/ledger', $accountId),
                $query,
                null,
                $pagination
            )->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getAccountLedger(
        string $accountId,
        ?PaginationInterface $pagination = null,
        ?DateTimeInterface $startDate = null,
        ?DateTimeInterface $endDate = null
    ): array {
        return AccountHistoryEventData::createCollectionFromJson($this->getAccountLedgerRaw($accountId, $pagination));
    }

    public function getHoldsRaw(string $accountId, ?PaginationInterface $pagination = null): string
    {
        return $this
            ->getRequestFactory()
            ->createRequest('GET', sprintf('/accounts/%s/holds', $accountId), [], null, $pagination)
            ->send()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getHolds(string $accountId, ?PaginationInterface $pagination = null): array
    {
        return HoldData::createCollectionFromJson($this->getHoldsRaw($accountId, $pagination));
    }

    public function getTransfersRaw(string $accountId, ?TransferTypeEnum $type = null, ?PaginationInterface $pagination = null): string
    {
        $query = [];

        if ($type) {
            $query['type'] = $type->value;
        }

        return $this->getRequestFactory()
            ->createRequest(
                'GET',
                sprintf('/accounts/%s/transfers', $accountId),
                $query,
                null,
                $pagination
            )
            ->send()
            ;
    }

    /**
     * {@inheritDoc}
     */
    public function getTransfers(string $accountId, ?TransferTypeEnum $type = null, ?PaginationInterface $pagination = null): array
    {
        return TransferData::createCollectionFromJson($this->getTransfersRaw($accountId, $type, $pagination));
    }
}
