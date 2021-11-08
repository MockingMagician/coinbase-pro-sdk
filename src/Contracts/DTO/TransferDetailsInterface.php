<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

interface TransferDetailsInterface
{
    public function getCoinbaseAccountId(): string;

    public function getCoinbaseTransactionId(): string;

    public function getCoinbasePaymentMethodId(): string;
}
