<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodDataInterface;

interface PaymentMethodsInterface
{
    /**
     * List Payment Methods.
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
