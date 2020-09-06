<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface CurrencyInfoData
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * [{
 *   "id": "BTC",
 *   "name": "Bitcoin",
 *   "min_size": "0.00000001"
 *   }, {
 *   "id": "USD",
 *   "name": "United States Dollar",
 *   "min_size": "0.01000000"
 * }]
 *
 * Really returned by API :
 *
 * {
 *   "id":"BAT",
 *   "name":"Basic Attention Token",
 *   "min_size":"1",
 *   "status":"online",
 *   "message":null,
 *   "details":
 *   {
 *     "type":"crypto",
 *     "symbol":"",
 *     "network_confirmations":35,
 *     "sort_order":10,
 *     "crypto_address_link":"https://etherscan.io/token/0x0d8775f648430679a709e98d2b0cb6250d2887ef?a={{address}}",
 *     "crypto_transaction_link":"https://etherscan.io/tx/0x{{txId}}",
 *     "push_payment_methods":[
 *       "crypto"
 *     ]
 *   },
 *   "max_precision":"1"
 * }
 */
interface CurrencyDataInterface
{
    const FIELDS = ['id', 'name', 'min_size'];

    public function getId(): string;
    public function getName(): string;
    public function getMinSize(): float;
    public function getExtraData(): array;
}
