<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodDataInterface;

interface PaymentMethodsInterface
{
    /**
     * List Payment Methods
     *
     * Get a list of your payment methods.
     *
     * HTTP REQUEST
     * GET /payment-methods
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "transfer" permission.
     *
     * @return PaymentMethodDataInterface[]
     */
    public function listPaymentMethods(): array;
}
