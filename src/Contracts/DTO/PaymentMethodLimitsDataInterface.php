<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

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
