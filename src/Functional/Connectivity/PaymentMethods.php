<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\PaymentMethodsInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\PaymentMethodData;

class PaymentMethods extends AbstractRequestFactoryAware implements PaymentMethodsInterface
{
    public function listPaymentMethodsRaw()
    {
        return $this->getRequestFactory()->createRequest('GET', '/payment-methods')->send();
    }

    /**
     * {@inheritdoc}
     */
    public function listPaymentMethods(): array
    {
        return PaymentMethodData::createCollectionFromJson($this->listPaymentMethodsRaw());
    }
}
