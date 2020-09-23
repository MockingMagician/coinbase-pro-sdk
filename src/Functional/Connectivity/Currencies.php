<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\CurrenciesInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CurrencyData;

class Currencies extends AbstractRequestManagerAware implements CurrenciesInterface
{
    public function getCurrenciesRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/currencies')->isSigned(false)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrencies(): array
    {
        return CurrencyData::createCollectionFromJson($this->getCurrenciesRaw());
    }
}
