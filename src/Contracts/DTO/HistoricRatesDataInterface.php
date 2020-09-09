<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface HistoricRateDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * [
 * [ time, low, high, open, close, volume ],
 * [ 1415398768, 0.32, 4.2, 0.35, 4.2, 12.3 ],
 * ...
 * ]
 */
interface HistoricRatesDataInterface
{
    public function getGranularity(): int;
    /**
     * @return HistoricRatesCandlesDataInterface[]
     */
    public function getCandles(): array;
}
