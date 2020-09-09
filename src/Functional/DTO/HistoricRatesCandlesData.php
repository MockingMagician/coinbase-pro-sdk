<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\HistoricRatesCandlesDataInterface;

class HistoricRatesCandlesData implements HistoricRatesCandlesDataInterface
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

    /**
     * @return int
     */
    public function getStartTime(): int
    {
        return $this->startTime;
    }

    /**
     * @return float
     */
    public function getLowestPrice(): float
    {
        return $this->lowestPrice;
    }

    /**
     * @return float
     */
    public function getHighestPrice(): float
    {
        return $this->highestPrice;
    }

    /**
     * @return float
     */
    public function getOpeningPrice(): float
    {
        return $this->openingPrice;
    }

    /**
     * @return float
     */
    public function getClosingPrice(): float
    {
        return $this->closingPrice;
    }

    /**
     * @return float
     */
    public function getTradingVolume(): float
    {
        return $this->tradingVolume;
    }

    public static function createCollectionFromArray(array $array)
    {
        foreach ($array as $k => $v) {
            $array[$k] = new self(
                $v[0],
                $v[1],
                $v[2],
                $v[3],
                $v[4],
                $v[5]
            );
        }

        return $array;
    }
}
