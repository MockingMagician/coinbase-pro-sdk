<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

use MockingMagician\CoinbaseProSdk\Functional\DTO\CurrencyData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ProductData;

class StatusMessage extends AbstractMessage
{
    /**
     * @var CurrencyData[]
     */
    private $currencies;
    /**
     * @var ProductData[]
     */
    private $products;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->currencies = [];
        $this->products = [];

        foreach ($payload['currencies'] as $currency) {
            $this->currencies[] = CurrencyData::createFromArray($currency);
        }

        foreach ($payload['products'] as $product) {
            $this->products[] = ProductData::createFromArray($product);
        }
    }

    /**
     * @return CurrencyData[]
     */
    public function getCurrencies(): array
    {
        return $this->currencies;
    }

    /**
     * @return ProductData[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}
