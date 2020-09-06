<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface AccountHistoryDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 *      * ENTRY TYPES
 * Entry type indicates the reason for the account change.
 *
 * Type    Description
 * transfer    Funds moved to/from Coinbase to Coinbase Pro
 * match    Funds moved as a result of a trade
 * fee    Fee as a result of a trade
 * rebate    Fee rebate as per our fee schedule
 * conversion    Funds converted between fiat currency and a stablecoin
 *
 * TODO here an example of what is show in the coinbase pro api return example
 * TODO need to realy check it
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
 */
interface AccountHistoryDataInterface
{
}
