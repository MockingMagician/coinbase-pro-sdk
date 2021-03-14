<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\L2UpdateChangeInterface;

class L2UpdateChange extends AbstractCreator implements L2UpdateChangeInterface
{
    /**
     * @var string
     */
    private $side;
    /**
     * @var float
     */
    private $price;
    /**
     * @var float
     */
    private $size;

    public function __construct(string $side, float $price, float $size)
    {
        $this->side = $side;
        $this->price = $price;
        $this->size = $size;
    }

    public function getSide(): string
    {
        return $this->side;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array[0],
            $array[1],
            $array[2]
        );
    }
}
