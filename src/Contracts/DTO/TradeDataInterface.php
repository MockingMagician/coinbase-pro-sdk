<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface TradeDataInterface.
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
