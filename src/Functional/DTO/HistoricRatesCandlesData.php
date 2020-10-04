<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\HistoricRatesCandlesDataInterface;

class HistoricRatesCandlesData extends AbstractCreator implements HistoricRatesCandlesDataInterface
{
    /**
     * @var int
     */
    private $startTime;
    /**
     * @var float
     */
    private $lowestPrice;
    /**
     * @var float
     */
    private $highestPrice;
    /**
     * @var float
     */
    private $openingPrice;
    /**
     * @var float
     */
    private $closingPrice;
    /**
     * @var float
     */
    private $tradingVolume;

    public function __construct(
        int $startTime,
        float $lowestPrice,
        float $highestPrice,
        float $openingPrice,
        float $closingPrice,
        float $tradingVolume
    ) {
        $this->startTime = $startTime;
        $this->lowestPrice = $lowestPrice;
        $this->highestPrice = $highestPrice;
        $this->openingPrice = $openingPrice;
        $this->closingPrice = $closingPrice;
        $this->tradingVolume = $tradingVolume;
    }

    public function getStartTime(): int
    {
        return $this->startTime;
    }

    public function getLowestPrice(): float
    {
        return $this->lowestPrice;
    }

    public function getHighestPrice(): float
    {
        return $this->highestPrice;
    }

    public function getOpeningPrice(): float
    {
        return $this->openingPrice;
    }

    public function getClosingPrice(): float
    {
        return $this->closingPrice;
    }

    public function getTradingVolume(): float
    {
        return $this->tradingVolume;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array[0],
            $array[1],
            $array[2],
            $array[3],
            $array[4],
            $array[5]
        );
    }
}
