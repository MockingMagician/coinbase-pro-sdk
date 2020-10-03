<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderBookDetailsDataInterface;

class OrderBookDetailsData extends AbstractCreator implements OrderBookDetailsDataInterface
{
    /**
     * @var float
     */
    private $price;
    /**
     * @var float
     */
    private $size;
    /**
     * @var null|int
     */
    private $numOrders;
    /**
     * @var null|string
     */
    private $orderId;

    public function __construct(float $price, float $size, ?int $numOrders, ?string $orderId)
    {
        $this->price = $price;
        $this->size = $size;
        $this->numOrders = $numOrders;
        $this->orderId = $orderId;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function getNumOrders(): ?int
    {
        return $this->numOrders;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array[0],
            $array[1],
            is_int($array[2]) ? $array[2] : null,
            is_string($array[2]) ? $array[2] : null
        );
    }
}
