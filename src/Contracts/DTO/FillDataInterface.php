<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface FillDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts
 *
 * [
 *   {
 *     "trade_id": 74,
 *     "product_id": "BTC-USD",
 *     "price": "10.00",
 *     "size": "0.01",
 *     "order_id": "d50ec984-77a8-460a-b958-66f114b0de9b",
 *     "created_at": "2014-11-07T22:19:28.578544Z",
 *     "liquidity": "T",
 *     "fee": "0.00025",
 *     "settled": true,
 *     "side": "buy"
 *   }
 * ]
 */
interface FillDataInterface
{
    public function getTradeId(): int;
    public function getProductId(): string;
    public function getPrice(): float;
    public function getSize(): float;
    public function getOrderId(): string;
    public function getCreatedAt(): DateTimeInterface;
    public function getLiquidity(): string;
    public function getFee(): float;
    public function isSettled(): bool;
    public function getSide(): string;
}
