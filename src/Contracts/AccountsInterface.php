<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


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
     * !!!This request is paginated
     *
     * HTTP REQUEST
     * GET /accounts/<account-id>/ledger
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * ENTRY TYPES
     * Entry type indicates the reason for the account change.
     *
     * Type	Description
     * transfer	Funds moved to/from Coinbase to Coinbase Pro
     * match	Funds moved as a result of a trade
     * fee	Fee as a result of a trade
     * rebate	Fee rebate as per our fee schedule
     * conversion	Funds converted between fiat currency and a stablecoin
     *
     * @todo here an example of what is show in the conbase pro api return example
     * @todo need to realy check it
     *
     * [
     *   {
     *     "id": "100",
     *     "created_at": "2014-11-07T08:19:27.028459Z",
     *     "amount": "0.001",
     *     "balance": "239.669",
     *     "type": "fee",
     *     "details": {
     *       "order_id": "d50ec984-77a8-460a-b958-66f114b0de9b",
     *       "trade_id": "74",
     *       "product_id": "BTC-USD"
     *     }
     *   }
     * ]
     *
     * @param string $id
     * @return AccountHistoryDataInterface[]
     */
    public function getAccountHistory(string $id): array;

    /**
     * @return array
     */
    public function getHolds(): array;
}
