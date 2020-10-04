<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\CurrenciesInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CurrencyData;

class Currencies extends AbstractRequestFactoryAware implements CurrenciesInterface
{
    public function getCurrenciesRaw(): string
    {
        return $this->getRequestFactory()->createRequest('GET', '/currencies')->setMustBeSigned(false)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrencies(): array
    {
        return CurrencyData::createCollectionFromJson($this->getCurrenciesRaw());
    }
}
