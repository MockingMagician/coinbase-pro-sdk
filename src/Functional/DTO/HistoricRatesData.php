<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\HistoricRatesCandlesDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\HistoricRatesDataInterface;

class HistoricRatesData extends AbstractCreator implements HistoricRatesDataInterface
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
        $this->candles = $candles;
        $this->granularity = $granularity;
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

    public static function createFromArray(array $array, ...$divers)
    {
        return new self($divers[0], HistoricRatesCandlesData::createCollectionFromArray($array));
    }

    public static function createFromJson(string $json, ...$divers)
    {
        return self::createFromArray(json_decode($json, true), $divers[0]);
    }
}
