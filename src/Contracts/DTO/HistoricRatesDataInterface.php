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
interface HistoricRatesDataInterface
{
    public function getGranularity(): int;

    /**
     * @return HistoricRatesCandlesDataInterface[]
     */
    public function getCandles(): array;
}
