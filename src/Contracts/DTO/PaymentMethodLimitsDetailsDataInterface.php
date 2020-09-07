<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;


interface PaymentMethodLimitsDetailsDataInterface
{
    public function getPeriodInDays(): int;
    public function getTotal(): PaymentMethodLimitsAmountDetailsDataInterface;
    public function getRemaining(): PaymentMethodLimitsAmountDetailsDataInterface;
}
