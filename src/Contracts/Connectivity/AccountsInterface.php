<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountHistoryEventDataInterface;

interface AccountsInterface
{
    /**
     * HTTP REQUEST
     * GET /accounts
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
     * GET /accounts/<account-id>
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * @param string $id
     * @return AccountDataInterface
     */
    public function getAccount(string $id): AccountDataInterface;

    /**
     * !!! This request is paginated
     *
     * HTTP REQUEST
     * GET /accounts/<account-id>/ledger
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     *
     * @param string $id
     * @param PaginationInterface|null $pagination null if get history from beginning
     *
     * @return AccountHistoryEventDataInterface[]
     */
    public function getAccountHistory(string $id, ?PaginationInterface $pagination = null): array;

    /**
     * !!! This request is paginated
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
     * TODO check returned data from api to define HoldDataInterface
     * [
     *   {
     *     "id": "82dcd140-c3c7-4507-8de4-2c529cd1a28f",
     *     "account_id": "e0b3f39a-183d-453e-b754-0c13e5bab0b3",
     *     "created_at": "2014-11-06T10:34:47.123456Z",
     *     "updated_at": "2014-11-06T10:40:47.123456Z",
     *     "amount": "4.23",
     *     "type": "order",
     *     "ref": "0a205de4-dd35-4370-a285-fe8fc375a273",
     *   }
     * ]
     *
     * @param string $id
     * @param PaginationInterface|null $pagination
     * @return array
     */
    public function getHolds(string $id, ?PaginationInterface $pagination = null): array;
}
