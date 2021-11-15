<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountHistoryEventDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\HoldDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TransferDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Enum\TransferTypeEnum;

interface AccountsInterface
{
    /**
     * Get a list of trading accounts from the profile of the API key.
     *
     * Request : GET /accounts
     *
     * API Key Permissions
     * This endpoint requires either the "view" or "trade" permission.
     *
     * Rate Limits
     * This endpoint has a custom rate limit by profile ID: 25 requests per second, up to 50 requests per second in bursts
     *
     * Funds on Hold
     * When you place an order, the funds for the order are placed on hold. They cannot be used for other orders or withdrawn.
     * Funds will remain on hold until the order is filled or canceled.
     *
     * @return AccountDataInterface[]
     */
    public function list(): array;

    /**
     * Information for a single account. Use this endpoint when you know the account_id.
     * API key must belong to the same profile as the account.
     *
     * Request : GET /accounts/{account_id}
     *
     * API Key Permissions
     * This endpoint requires either the "view" or "trade" permission.
     */
    public function getAccount(string $accountId): AccountDataInterface;

    /**
     * List the holds of an account that belong to the same profile as the API key.
     * Holds are placed on an account for any active orders or pending withdraw requests.
     * As an order is filled, the hold amount is updated. If an order is canceled, any remaining hold is removed.
     * For withdrawals, the hold is removed after it is completed.
     *
     * This request is paginated.
     *
     * Request :  GET /accounts/{account_id}/holds
     *
     * @return HoldDataInterface[]
     */
    public function getHolds(string $accountId, ?PaginationInterface $pagination = null): array;

    /**
     * List account activity of the API key's profile.
     * Account activity either increases or decreases your account balance.
     *
     * This request is paginated.
     *
     * Request : GET /accounts/{account_id}/ledger
     *
     * API Key Permissions
     * This endpoint requires either the "view" or "trade" permission.
     *
     * @return AccountHistoryEventDataInterface[]
     */
    public function getAccountLedger(
        string $accountId,
        ?PaginationInterface $pagination = null,
        ?DateTimeInterface $startDate = null,
        ?DateTimeInterface $endDate = null
    ): array;

    /**
     * Lists past withdrawals and deposits for an account.
     *
     * This request is paginated.
     *
     * Request : GET /accounts/{account_id}/transfers
     *
     * @return TransferDataInterface[]
     */
    public function getTransfers(string $accountId, ?TransferTypeEnum $type = null, ?PaginationInterface $pagination = null): array;
}
