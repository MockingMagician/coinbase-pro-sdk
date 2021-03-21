<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\CurrencyDetailsDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CurrencyData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\CurrencyData
 *
 * @internal
 */
class CurrencyDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [[
            '{
                "id": "BTC",
                "name": "Bitcoin",
                "min_size": "0.00000001",
                "status": "online",
                "message": null,
                "details": {
                    "type": "crypto",
                    "symbol": "",
                    "network_confirmations": 6,
                    "sort_order": 3,
                    "crypto_address_link": "https:\/\/live.blockcypher.com\/btc\/address\/{{address}}",
                    "crypto_transaction_link": "https:\/\/live.blockcypher.com\/btc\/tx\/{{txId}}",
                    "push_payment_methods": [
                        "crypto"
                    ],
                    "group_types": [
                        "btc",
                        "crypto"
                    ]
                },
                "max_precision": "0.00000001"
            }',
        ]];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "id": "BAT",
                    "name": "Basic Attention Token",
                    "min_size": "1",
                    "status": "online",
                    "message": null,
                    "details": {
                        "type": "crypto",
                        "symbol": "",
                        "network_confirmations": 35,
                        "sort_order": 10,
                        "crypto_address_link": "https:\/\/etherscan.io\/token\/0x0d8775f648430679a709e98d2b0cb6250d2887ef?a={{address}}",
                        "crypto_transaction_link": "https:\/\/etherscan.io\/tx\/0x{{txId}}",
                        "push_payment_methods": [
                            "crypto"
                        ]
                    },
                    "max_precision": "1"
                },
                {
                    "id": "LINK",
                    "name": "Chainlink",
                    "min_size": "1",
                    "status": "online",
                    "message": null,
                    "details": {
                        "type": "crypto",
                        "symbol": "\u039e",
                        "network_confirmations": 35,
                        "sort_order": 67,
                        "crypto_address_link": "https:\/\/etherscan.io\/token\/0x514910771af9ca656af840dff83e8264ecf986ca?a={{address}}",
                        "crypto_transaction_link": "https:\/\/etherscan.io\/tx\/0x{{txId}}",
                        "push_payment_methods": [
                            "crypto"
                        ]
                    },
                    "max_precision": "0.00000001"
                },
                {
                    "id": "USD",
                    "name": "United States Dollar",
                    "min_size": "0.01",
                    "status": "online",
                    "message": null,
                    "details": {
                        "type": "fiat",
                        "symbol": "$",
                        "sort_order": 0,
                        "push_payment_methods": [
                            "bank_wire",
                            "swift_bank_account",
                            "intra_bank_account"
                        ],
                        "display_name": "US Dollar",
                        "group_types": [
                            "fiat",
                            "usd"
                        ]
                    },
                    "max_precision": "0.01",
                    "convertible_to": [
                        "USDC"
                    ]
                },
                {
                    "id": "BTC",
                    "name": "Bitcoin",
                    "min_size": "0.00000001",
                    "status": "online",
                    "message": null,
                    "details": {
                        "type": "crypto",
                        "symbol": "",
                        "network_confirmations": 6,
                        "sort_order": 3,
                        "crypto_address_link": "https:\/\/live.blockcypher.com\/btc\/address\/{{address}}",
                        "crypto_transaction_link": "https:\/\/live.blockcypher.com\/btc\/tx\/{{txId}}",
                        "push_payment_methods": [
                            "crypto"
                        ],
                        "group_types": [
                            "btc",
                            "crypto"
                        ]
                    },
                    "max_precision": "0.00000001"
                },
                {
                    "id": "GBP",
                    "name": "British Pound",
                    "min_size": "0.01",
                    "status": "online",
                    "message": null,
                    "details": {
                        "type": "fiat",
                        "symbol": "\u00a3",
                        "sort_order": 2,
                        "push_payment_methods": [
                            "uk_bank_account",
                            "swift_lhv"
                        ],
                        "group_types": [
                            "fiat",
                            "gbp"
                        ]
                    },
                    "max_precision": "0.01"
                },
                {
                    "id": "EUR",
                    "name": "Euro",
                    "min_size": "0.01",
                    "status": "online",
                    "message": null,
                    "details": {
                        "type": "fiat",
                        "symbol": "\u20ac",
                        "sort_order": 1,
                        "push_payment_methods": [
                            "sepa_bank_account"
                        ],
                        "group_types": [
                            "fiat",
                            "eur"
                        ]
                    },
                    "max_precision": "0.01"
                },
                {
                    "id": "ETH",
                    "name": "Ether",
                    "min_size": "0.00000001",
                    "status": "online",
                    "message": null,
                    "details": {
                        "type": "crypto",
                        "symbol": "",
                        "network_confirmations": 35,
                        "sort_order": 7,
                        "crypto_address_link": "https:\/\/etherscan.io\/address\/{{address}}",
                        "crypto_transaction_link": "https:\/\/etherscan.io\/tx\/0x{{txId}}",
                        "push_payment_methods": [
                            "crypto"
                        ],
                        "group_types": [
                            "eth",
                            "crypto"
                        ]
                    },
                    "max_precision": "0.00000001"
                },
                {
                    "id": "USDC",
                    "name": "USD Coin",
                    "min_size": "0.000001",
                    "status": "online",
                    "message": null,
                    "details": {
                        "type": "crypto",
                        "symbol": "$",
                        "network_confirmations": 35,
                        "sort_order": 9,
                        "crypto_address_link": "https:\/\/etherscan.io\/token\/0xa0b86991c6218b36c1d19d4a2e9eb0ce3606eb48?a={{address}}",
                        "crypto_transaction_link": "https:\/\/etherscan.io\/tx\/0x{{txId}}",
                        "push_payment_methods": [
                            "crypto"
                        ],
                        "group_types": [
                            "stablecoin",
                            "usdc",
                            "crypto"
                        ]
                    },
                    "max_precision": "0.000001",
                    "convertible_to": [
                        "USD"
                    ]
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var CurrencyData $currency */
        $currency = CurrencyData::createFromJson($json);
        self::assertInstanceOf(CurrencyData::class, $currency);
        self::assertEquals('BTC', $currency->getId());
        self::assertEquals('Bitcoin', $currency->getName());
        self::assertEquals(0.00000001, $currency->getMinSize());
        self::assertNullOrEquals('online', $currency->getStatus());
        self::assertNullOrEquals('message', $currency->getStatusMessage());
        self::assertNullOrEquals(0.00000001, $currency->getMaxPrecision());
        self::assertInstanceOf(CurrencyDetailsDataInterface::class, $currency->getDetails());
        self::assertIsArray($currency->getExtraData());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = CurrencyData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(CurrencyData::class, $value);
        }
    }
}
