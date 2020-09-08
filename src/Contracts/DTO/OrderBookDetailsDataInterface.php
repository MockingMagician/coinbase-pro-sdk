<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;


interface OrderBookDetailsDataInterface
{
    public function getPrice(): float;
    public function getSize(): float;
    public function getNumOrders(): ?int;
    public function getOrderId(): ?string;
}
