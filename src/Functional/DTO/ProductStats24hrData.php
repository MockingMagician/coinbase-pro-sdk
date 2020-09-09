<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProductStats24hrDataInterface;

class ProductStats24hrData implements ProductStats24hrDataInterface
{
    /**
     * @var float
     */
    private $open;
    /**
     * @var float
     */
    private $high;
    /**
     * @var float
     */
    private $low;
    /**
     * @var float
     */
    private $volume;
    /**
     * @var float
     */
    private $last;
    /**
     * @var float
     */
    private $volume30day;

    public function __construct(
        float $open,
        float $high,
        float $low,
        float $volume,
        float $last,
        float $volume30day
    ) {
        $this->open = $open;
        $this->high = $high;
        $this->low = $low;
        $this->volume = $volume;
        $this->last = $last;
        $this->volume30day = $volume30day;
    }

    /**
     * @return float
     */
    public function getOpen(): float
    {
        return $this->open;
    }

    /**
     * @return float
     */
    public function getHigh(): float
    {
        return $this->high;
    }

    /**
     * @return float
     */
    public function getLow(): float
    {
        return $this->low;
    }

    /**
     * @return float
     */
    public function getVolume(): float
    {
        return $this->volume;
    }

    /**
     * @return float
     */
    public function getLast(): float
    {
        return $this->last;
    }

    /**
     * @return float
     */
    public function getVolume30day(): float
    {
        return $this->volume30day;
    }

    public static function createFromArray(array $array)
    {
        return new self(
            $array['open'],
            $array['high'],
            $array['low'],
            $array['volume'],
            $array['last'],
            $array['volume_30day']
        );
    }

    public static function createFromJson(string $json)
    {
        return self::createFromArray(json_decode($json, true));
    }
}
