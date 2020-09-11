<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

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
 * here an example of what is show in the coinbase pro api return example
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
 * data returned by test api is a bit different and can be various in details field, so let in array until now
 *
 * {"id":"152801121","amount":"5.0000000000000000","balance":"245.0000000000000000","created_at":"2020-09-10T23:40:44.656215Z","type":"transfer","details":{"transfer_id":"525002a3-c832-4872-becf-5edc503f7040","transfer_type":"deposit"}
 */
interface AccountHistoryEventDataInterface
{
    const TYPE_TRANSFER = 'transfer';
    const TYPE_MATCH = 'match';
    const TYPE_FEE = 'fee';
    const TYPE_REBATE = 'rebate';
    const TYPE_CONVERSION = 'conversion';
    const TYPES = [
        self::TYPE_TRANSFER,
        self::TYPE_MATCH,
        self::TYPE_FEE,
        self::TYPE_REBATE,
        self::TYPE_CONVERSION,
    ];

    public function getId(): string;
    public function getCreatedAt(): DateTimeInterface;
    public function getAmount(): float;
    public function getBalance(): float;
    public function getType(): string;
    public function getDetails(): array;
}
