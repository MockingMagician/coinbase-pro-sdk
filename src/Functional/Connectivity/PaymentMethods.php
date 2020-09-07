<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\PaymentMethodsInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\PaymentMethodData;

class PaymentMethods extends AbstractRequestManagerAware implements PaymentMethodsInterface
{
    public function listPaymentMethodsRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/payment-methods')->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function listPaymentMethods(): array
    {
        return PaymentMethodData::createCollectionFromJson($this->listPaymentMethodsRaw());
    }
}
