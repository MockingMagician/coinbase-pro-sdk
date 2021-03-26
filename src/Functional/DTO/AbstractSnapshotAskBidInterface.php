<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

abstract class AbstractSnapshotAskBidInterface extends AbstractCreator
{
    /**
     * @var float
     */
    private $price;
    /**
     * @var float
     */
    private $size;

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function __construct(float $price, float $size)
    {
        $this->price = $price;
        $this->size = $size;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array[0],
            $array[1]
        );
    }
}
