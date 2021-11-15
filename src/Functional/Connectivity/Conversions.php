<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ConversionsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\ConversionDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ConversionData;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

class Conversions extends AbstractConnectivity implements ConversionsInterface
{
    public function convertRaw(string $from, string $to, float $amount, ?string $nonce = null): string
    {
        $body = [
            'from' => $from,
            'to' => $to,
            'amount' => $amount,
        ];

        if ($nonce) {
            $body['nonce'] = $nonce;
        }

        return $this->getRequestFactory()->createRequest('POST', '/conversions', [], Json::encode($body))->send();
    }

    /**
     * {@inheritDoc}
     */
    public function convert(string $from, string $to, float $amount, ?string $nonce = null): ConversionDataInterface
    {
        return ConversionData::createFromJson($this->convertRaw($from, $to, $amount, $nonce));
    }

    public function getConversionRaw(string $conversionId): string
    {
        return $this->getRequestFactory()->createRequest('GET', sprintf('/conversions/%s', $conversionId))->send();
    }

    public function getConversion(string $conversionId): ConversionDataInterface
    {
        return ConversionData::createFromJson($this->getConversionRaw($conversionId));
    }
}
