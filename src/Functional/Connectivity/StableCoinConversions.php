<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\StableCoinConversionsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\StableCoinConversionsDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\StableCoinConversionsData;

class StableCoinConversions extends AbstractRequestFactoryAware implements StableCoinConversionsInterface
{
    public function createConversionRaw(string $fromCurrencyId, string $toCurrencyId, float $amount): string
    {
        $body = [
            'from' => $fromCurrencyId,
            'to' => $toCurrencyId,
            'amount' => $amount,
        ];

        return $this->getRequestFactory()->createRequest('POST', '/conversions', [], json_encode($body))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function createConversion(string $fromCurrencyId, string $toCurrencyId, float $amount): StableCoinConversionsDataInterface
    {
        return StableCoinConversionsData::createFromJson($this->createConversionRaw($fromCurrencyId, $toCurrencyId, $amount));
    }
}
