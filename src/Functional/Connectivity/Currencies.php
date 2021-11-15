<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\CurrenciesInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\CurrencyDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CurrencyData;

class Currencies extends AbstractConnectivity implements CurrenciesInterface
{
    public function listRaw(): string
    {
        return $this->getRequestFactory()->createRequest('GET', '/currencies')->setMustBeSigned(false)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function list(): array
    {
        return CurrencyData::createCollectionFromJson($this->listRaw());
    }

    public function getCurrencyRaw(string $currencyId): string
    {
        return $this->getRequestFactory()->createRequest('GET', sprintf('/currencies/%s', $currencyId))->setMustBeSigned(false)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrency(string $currencyId): CurrencyDataInterface
    {
        return CurrencyData::createFromJson($this->getCurrencyRaw($currencyId));
    }
}
