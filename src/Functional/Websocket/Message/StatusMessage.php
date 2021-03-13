<?php


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
        foreach ($payload['currencies'] as $currency) {
            $this->currencies[] = CurrencyData::createFromArray($currency);
        }
        $this->products = [];
        foreach ($payload['products'] as $product) {
//            dump($product);
            if (!isset($product['trading_disabled'])) {
//                dump($product);
//                die;
            }
            $this->products[] = ProductData::createFromArray($product);
        }
    }
}
