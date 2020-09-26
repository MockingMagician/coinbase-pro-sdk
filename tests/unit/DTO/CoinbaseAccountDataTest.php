<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\AccountData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CoinbaseAccountData;
use PHPUnit\Framework\TestCase;

class CoinbaseAccountDataTest extends TestCase
{
    public function provideValidJsonData()
    {
        return [[
            '{
                "id": "bcdd4c40-df40-5d76-810c-74aab722b223",
                "name": "USD Wallet",
                "balance": "210480.00000000",
                "currency": "USD",
                "type": "fiat",
                "primary": false,
                "active": true,
                "available_on_consumer": true,
                "wire_deposit_information": {
                    "account_number": "12345678912",
                    "routing_number": "1234567",
                    "bank_name": "Coinbase Test Bank",
                    "bank_address": "1 Test Bank Drive, Nowhere",
                    "bank_country": {
                        "code": "US",
                        "name": "United States"
                    },
                    "account_name": "Coinbase, Inc",
                    "account_address": "548 Market Street, #23008, San Francisco, CA 94104",
                    "reference": "TESTREFERENCE"
                },
                "hold_balance": "5000.00",
                "hold_currency": "USD"
            }',
        ]];
    }
    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "id": "95671473-4dda-5264-a654-fc6923e8a334",
                    "name": "Fake",
                    "balance": "50.00000000",
                    "currency": "BTC",
                    "type": "wallet",
                    "primary": true,
                    "active": true,
                    "available_on_consumer": true,
                    "hold_balance": "5000.00",
                    "hold_currency": "USD"
                },
                {
                    "id": "95671473-4dda-5264-a654-fc6923e8a335",
                    "name": "All the Ether",
                    "balance": "1000.00000000",
                    "currency": "ETH",
                    "type": "wallet",
                    "primary": false,
                    "active": true,
                    "available_on_consumer": true,
                    "hold_balance": "5000.00",
                    "hold_currency": "USD"
                },
                {
                    "id": "95671473-4dda-5264-a654-fc6923e8a339",
                    "name": "USDC Wallet",
                    "balance": "100000.00000",
                    "currency": "USDC",
                    "type": "wallet",
                    "primary": false,
                    "active": true,
                    "available_on_consumer": true,
                    "hold_balance": "5000.00",
                    "hold_currency": "USD"
                },
                {
                    "id": "95671473-4dda-5264-a654-fc6923e8a341",
                    "name": "BAT Wallet",
                    "balance": "100000.00000000",
                    "currency": "BAT",
                    "type": "wallet",
                    "primary": false,
                    "active": true,
                    "available_on_consumer": true,
                    "hold_balance": "5000.00",
                    "hold_currency": "USD"
                },
                {
                    "id": "bcdd4c40-df40-5d76-810c-74aab722b223",
                    "name": "USD Wallet",
                    "balance": "210480.00000000",
                    "currency": "USD",
                    "type": "fiat",
                    "primary": false,
                    "active": true,
                    "available_on_consumer": true,
                    "wire_deposit_information": {
                        "account_number": "12345678912",
                        "routing_number": "1234567",
                        "bank_name": "Coinbase Test Bank",
                        "bank_address": "1 Test Bank Drive, Nowhere",
                        "bank_country": {
                            "code": "US",
                            "name": "United States"
                        },
                        "account_name": "Coinbase, Inc",
                        "account_address": "548 Market Street, #23008, San Francisco, CA 94104",
                        "reference": "TESTREFERENCE"
                    },
                    "hold_balance": "5000.00",
                    "hold_currency": "USD"
                },
                {
                    "id": "47f515a1-f035-5ce1-9c68-1a986548ee15",
                    "name": "EUR Wallet",
                    "balance": "210480.00000000",
                    "currency": "EUR",
                    "type": "fiat",
                    "primary": false,
                    "active": true,
                    "available_on_consumer": true,
                    "sepa_deposit_information": {
                        "iban": "EE957700771001355096",
                        "swift": "LHVBEE22",
                        "bank_name": "AS LHV Pank",
                        "bank_address": "Tartu mnt 2, 10145 Tallinn, Estonia",
                        "bank_country_name": "Estonia",
                        "account_name": "Coinbase UK, Ltd.",
                        "account_address": "9th Floor, 107 Cheapside, London, EC2V 6DN, United Kingdom",
                        "reference": "CBAEUROVFXOMYXEXC"
                    },
                    "hold_balance": "5000.00",
                    "hold_currency": "USD"
                },
                {
                    "id": "eafc4cb3-600c-5ba1-b9be-b693e7acce52",
                    "name": "GBP Wallet",
                    "balance": "210480.00000000",
                    "currency": "GBP",
                    "type": "fiat",
                    "primary": false,
                    "active": true,
                    "available_on_consumer": true,
                    "uk_deposit_information": {
                        "sort_code": "20-06-05",
                        "account_name": "CB PAYMENTS, LTD",
                        "account_number": "63056902",
                        "bank_name": "BARCLAYS BANK PLC",
                        "reference": "CBAEURKBJGZAULEXC"
                    },
                    "hold_balance": "5000.00",
                    "hold_currency": "USD"
                },
                {
                    "id": "24df678d-809e-5332-8170-f3048e2908f2",
                    "name": "Zero Hero",
                    "balance": "0.00000000",
                    "currency": "USD",
                    "type": "fiat",
                    "primary": false,
                    "active": true,
                    "available_on_consumer": true,
                    "hold_balance": "5000.00",
                    "hold_currency": "USD"
                },
                {
                    "id": "95671473-4dda-5264-a654-fc6923e8a358",
                    "name": "LINK Wallet",
                    "balance": "100000.00000000",
                    "currency": "LINK",
                    "type": "wallet",
                    "primary": false,
                    "active": true,
                    "available_on_consumer": true,
                    "hold_balance": "5000.00",
                    "hold_currency": "USD"
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var CoinbaseAccountData $coinbaseAccountData */
        $coinbaseAccountData = CoinbaseAccountData::createFromJson($json);
        self::assertInstanceOf(CoinbaseAccountData::class, $coinbaseAccountData);
        self::assertEquals('bcdd4c40-df40-5d76-810c-74aab722b223', $coinbaseAccountData->getId());
        self::assertEquals('USD Wallet', $coinbaseAccountData->getName());
        self::assertEquals(210480, $coinbaseAccountData->getBalance());
        self::assertEquals('USD', $coinbaseAccountData->getCurrency());
        self::assertEquals('fiat', $coinbaseAccountData->getType());
        self::assertEquals(false, $coinbaseAccountData->isPrimary());
        self::assertEquals(true, $coinbaseAccountData->isActive());
        self::assertEquals(true, $coinbaseAccountData->isAvailableOnConsumer());
        self::assertEquals(5000, $coinbaseAccountData->getHoldBalance());
        self::assertEquals('USD', $coinbaseAccountData->getHoldCurrency());
        self::assertEquals([
            "wire_deposit_information" => [
                "account_number" => "12345678912",
                "routing_number" => "1234567",
                "bank_name" => "Coinbase Test Bank",
                "bank_address" => "1 Test Bank Drive, Nowhere",
                "bank_country" => [
                    "code" => "US",
                    "name" => "United States"
                ],
                "account_name" => "Coinbase, Inc",
                "account_address" => "548 Market Street, #23008, San Francisco, CA 94104",
                "reference" => "TESTREFERENCE"
            ]
        ], $coinbaseAccountData->getExtraData());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = CoinbaseAccountData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(CoinbaseAccountData::class, $value);
        }
    }
}
