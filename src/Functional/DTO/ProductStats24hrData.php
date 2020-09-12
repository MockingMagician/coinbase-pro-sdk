<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProductStats24hrDataInterface;

class ProductStats24hrData extends AbstractCreator implements ProductStats24hrDataInterface
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

    public function getOpen(): float
    {
        return $this->open;
    }

    public function getHigh(): float
    {
        return $this->high;
    }

    public function getLow(): float
    {
        return $this->low;
    }

    public function getVolume(): float
    {
        return $this->volume;
    }

    public function getLast(): float
    {
        return $this->last;
    }

    public function getVolume30day(): float
    {
        return $this->volume30day;
    }

    public static function createFromArray(array $array, ...$divers)
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
}
