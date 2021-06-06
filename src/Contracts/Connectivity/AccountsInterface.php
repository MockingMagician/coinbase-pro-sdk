<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountHistoryEventDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\HoldDataInterface;

interface AccountsInterface
{
    /**
     * HTTP REQUEST
     * GET /accounts.
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * RATE LIMITS
     * This endpoint has a custom rate limit by profile ID: 25 requests per second, up to 50 requests per second in bursts
     *
     * @return AccountDataInterface[]
     */
    public function list(): array;

    /**
     * HTTP REQUEST
     * GET /accounts/<account-id>.
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     */
    public function getAccount(string $id): AccountDataInterface;

    /**
     * !!! This request is paginated.
     *
     * HTTP REQUEST
     * GET /accounts/<account-id>/ledger
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * @param null|PaginationInterface $pagination null if get history from beginning
     *
     * @return AccountHistoryEventDataInterface[]
     */
    public function getAccountHistory(string $id, ?PaginationInterface $pagination = null): array;

    /**
     * !!! This request is paginated.
     *
     * HTTP REQUEST
     * GET /accounts/<account_id>/holds
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * TYPE
     * The type of the hold will indicate why the hold exists.
     * The hold type is order for holds related to open orders and transfer for holds related to a withdraw.
     *
     * REF
     * The ref field contains the id of the order or transfer which created the hold.
     *
     * @return HoldDataInterface[]
     */
    public function getHolds(string $id, ?PaginationInterface $pagination = null): array;
}
