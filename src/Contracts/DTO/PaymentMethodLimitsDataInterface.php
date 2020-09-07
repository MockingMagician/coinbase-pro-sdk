<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;


interface PaymentMethodLimitsDataInterface
{
    /**
     * @return PaymentMethodLimitsDetailsDataInterface[]
     */
    public function getBuy(): array;
    /**
     * @return PaymentMethodLimitsDetailsDataInterface[]
     */
    public function getInstantBuy(): array;
    /**
     * @return PaymentMethodLimitsDetailsDataInterface[]
     */
    public function getSell(): array;
    /**
     * @return PaymentMethodLimitsDetailsDataInterface[]
     */
    public function getDeposit(): array;
}
