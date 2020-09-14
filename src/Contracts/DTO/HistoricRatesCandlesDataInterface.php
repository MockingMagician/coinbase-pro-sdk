<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface HistoricRateDataInterface.
 */
interface HistoricRatesCandlesDataInterface
{
    public function getStartTime(): int;

    public function getLowestPrice(): float;

    public function getHighestPrice(): float;

    public function getOpeningPrice(): float;

    public function getClosingPrice(): float;

    public function getTradingVolume(): float;
}
