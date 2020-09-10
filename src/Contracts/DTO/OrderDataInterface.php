<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface OrderDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts
 *
 * In doc api :
 *
 * {
 *   "id": "d0c5340b-6d6c-49d9-b567-48c4bfca13d2",
 *   "price": "0.10000000",
 *   "size": "0.01000000",
 *   "product_id": "BTC-USD",
 *   "side": "buy",
 *   "stp": "dc",
 *   "type": "limit",
 *   "time_in_force": "GTC",
 *   "post_only": false,
 *   "created_at": "2016-12-08T20:02:28.53864Z",
 *   "fill_fees": "0.0000000000000000",
 *   "filled_size": "0.00000000",
 *   "executed_value": "0.0000000000000000",
 *   "status": "pending",
 *   "settled": false   $this->status = $status;
 * }
 *
 *
 * returned by test api :
 *
 * {
 *    "id":"ef94de96-b24b-4fd3-835f-fb7190613c11",
 *    // price missing
 *    "size":"0.1",
 *    "funds":"412243.54103699", // Not exist in documentation
 *    "product_id":"BTC-USD",
 *    "side":"buy",
 *    "stp":"cn",
 *    "type":"market",
 *    // time_in_force missing
 *    "post_only":false,
 *    "created_at":"2020-09-10T16:10:42.158563Z",
 *    "fill_fees":"0",
 *    "filled_size":"0",
 *    "executed_value":"0",
 *    "status":"pending",
 *    "settled":false
 * }
 */
interface OrderDataInterface
{
    public function getId(): string;
    public function getPrice(): ?float;
    public function getSize(): ?float;
    public function getFunds(): ?float;
    public function getProductId(): string;
    public function getSide(): string;
    public function getSelfTradePrevention(): string;
    public function getType(): string;
    public function getTimeInForce(): ?string;
    public function isPostOnly(): bool;
    public function getCreatedAt(): DateTimeInterface;
    public function getFillFees(): float;
    public function getFilledSize(): float;
    public function getExecutedValue(): float;
    public function getStatus(): string;
    public function isSettled(): bool;
}
