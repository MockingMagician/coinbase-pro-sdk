<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;


use MockingMagician\CoinbaseProSdk\Functional\DTO\ProductData;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\Fragment\Currency;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\Fragment\CurrencyDetails;

class StatusMessage extends AbstractMessage
{
    /**
     * @var Currency[]
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
            $this->currencies[] = new Currency(
                $currency['id'],
                $currency['name'],
                $currency['min_size'],
                $currency['status'],
                $currency['funding_account_id'],
                $currency['status_message'],
                $currency['max_precision'],
                $currency['convertible_to'],
                new CurrencyDetails(
                    $currency['details']['type'],
                    $currency['details']['symbol'],
                    $currency['details']['network_confirmations'],
                    $currency['details']['sort_order'],
                    $currency['details']['crypto_address_link'],
                    $currency['details']['crypto_transaction_link'],
                    $currency['details']['push_payment_methods'],
                    $currency['details']['processing_time_seconds'] ?? null,
                    $currency['details']['min_withdrawal_amount'] ?? null,
                    $currency['details']['max_withdrawal_amount'] ?? null
                )
            );
        }
        $this->products = [];
        foreach ($payload['products'] as $product) {
            $this->products[] = ProductData::createFromArray($payload);
        }
    }
}
