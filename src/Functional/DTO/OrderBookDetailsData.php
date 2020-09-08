<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderBookDetailsDataInterface;

class OrderBookDetailsData implements OrderBookDetailsDataInterface
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
     * @var int|null
     */
    private $numOrders;
    /**
     * @var string|null
     */
    private $orderId;

    public function __construct(float $price, float $size, ?int $numOrders, ?string $orderId)
    {
        $this->price = $price;
        $this->size = $size;
        $this->numOrders = $numOrders;
        $this->orderId = $orderId;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getSize(): float
    {
        return $this->size;
    }

    /**
     * @return int|null
     */
    public function getNumOrders(): ?int
    {
        return $this->numOrders;
    }

    /**
     * @return string|null
     */
    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public static function createFromArray(array $array)
    {
        return new self(
            $array[0],
            $array[1],
            is_int($array[2]) ? $array[2] : null,
            is_string($array[2]) ? $array[2] : null
        );
    }
}
