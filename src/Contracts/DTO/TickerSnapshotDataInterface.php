<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface SnapshotTickerDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 * {
 *   "trade_id": 4729088,
 *   "price": "333.99",
 *   "size": "0.193",
 *   "bid": "333.98",
 *   "ask": "333.99",
 *   "volume": "5957.11914015",
 *   "time": "2015-11-14T20:46:03.511254Z"
 * }
 */
interface TickerSnapshotDataInterface
{
    public function getTradeId(): int;
    public function getPrice(): float;
    public function getSize(): float;
    public function getBid(): float;
    public function getAsk(): float;
    public function getVolume(): float;
    public function getTime(): DateTimeInterface;
}
