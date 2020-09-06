<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\CurrenciesInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CurrencyData;

class Currencies extends AbstractConnectivity implements CurrenciesInterface
{
    public function getCurrenciesRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/currencies')->send();
    }

    /**
     * @inheritDoc
     */
    public function getCurrencies(): array
    {
        return CurrencyData::createCollectionFromJson($this->getCurrenciesRaw());
    }
}
