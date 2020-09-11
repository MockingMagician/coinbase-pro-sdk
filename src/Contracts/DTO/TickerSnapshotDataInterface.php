<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface SnapshotTickerDataInterface.
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
