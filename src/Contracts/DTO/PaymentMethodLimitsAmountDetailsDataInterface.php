<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;


interface PaymentMethodLimitsAmountDetailsDataInterface
{
    public function getAmount(): float;
    public function getCurrency(): string;
}
