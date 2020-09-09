<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface TradeDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * {
 *   "time": "2014-11-07T22:19:28.578544Z",
 *   "trade_id": 74,
 *   "price": "10.00000000",
 *   "size": "0.01000000",
 *   "side": "buy"
 * },
 * {
 *   "time": "2014-11-07T01:08:43.642366Z",
 *   "trade_id": 73,
 *   "price": "100.00000000",
 *   "size": "0.01000000",
 *   "side": "sell" *
 * }
 */
interface TradeDataInterface
{
    const SIDE_BUY = 'buy';
    const SIDE_SELL = 'sell';
    const SIDES = [
        self::SIDE_BUY,
        self::SIDE_SELL,
    ];

    public function getTime(): DateTimeInterface;
    public function getTradeId(): int;
    public function getPrice(): float;
    public function getSize(): float;
    public function getSide(): string;
}
