<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\HistoricRatesCandlesDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\HistoricRatesDataInterface;

class HistoricRatesData implements HistoricRatesDataInterface
{
    /**
     * @var int
     */
    private $granularity;
    /**
     * @var HistoricRatesCandlesDataInterface[]
     */
    private $candles;

    /**
     * HistoricRatesData constructor.
     *
     * @param HistoricRatesCandlesDataInterface[] $candles
     */
    public function __construct(
        int $granularity,
        array $candles
    ) {
        $this->granularity = $granularity;
        $this->candles = $candles;
    }

    public function getGranularity(): int
    {
        return $this->granularity;
    }

    /**
     * @return HistoricRatesCandlesDataInterface[]
     */
    public function getCandles(): array
    {
        return $this->candles;
    }

    public static function createFromArray(int $granularity, array $array)
    {
        return new self($granularity, HistoricRatesCandlesData::createCollectionFromArray($array));
    }

    public static function createFromJson(int $granularity, string $json)
    {
        return self::createFromArray($granularity, json_decode($json, true));
    }
}
