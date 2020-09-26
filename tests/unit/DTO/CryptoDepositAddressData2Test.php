<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\AccountData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CoinbaseAccountData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CryptoDepositAddressData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CryptoDepositAddressInfoData;
use PHPUnit\Framework\TestCase;

class CryptoDepositAddressDataTest extends TestCase
{
    public function provideValidJsonData()
    {
        return [[
            '{
                "id": "7b147f5d-79de-4d3b-b116-446b259f8765",
                "address": "cx3iotaZqweMa7bABi4bRWq6rpponnOIFa",
                "destination_tag": "3299925630",
                "address_info": {
                    "address": "cx3iotaZqweMa7bABi4bRWq6rpponnOIFa",
                    "destination_tag": "4938102"
                },
                "created_at": "2020-06-17T20:35:38Z",
                "updated_at": "2020-06-17T20:35:38Z",
                "network": "ripple",
                "resource": "address",
                "deposit_uri": "xrp:cx3iotaZqweMa7bABi4bRWq6rpponnOIFa?dt=4938102",
                "exchange_deposit_address": true
            }',
        ]];
    }
    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "id": "7b147f5d-79de-4d3b-b116-446b259f8765",
                    "address": "cx3iotaZqweMa7bABi4bRWq6rpponnOIFa",
                    "destination_tag": "3299925630",
                    "address_info": {
                        "address": "cx3iotaZqweMa7bABi4bRWq6rpponnOIFa",
                        "destination_tag": "4938102"
                    },
                    "created_at": "2020-06-17T20:35:38Z",
                    "updated_at": "2020-06-17T20:35:38Z",
                    "network": "ripple",
                    "resource": "address",
                    "deposit_uri": "xrp:cx3iotaZqweMa7bABi4bRWq6rpponnOIFa?dt=4938102",
                    "exchange_deposit_address": true
                },
                {
                    "id": "7b147f5d-79de-4d3b-b116-446b259f8765",
                    "address": "okr45dek7rtg47bABi4bRWq6rpponnOIFa",
                    "destination_tag": "3299925630",
                    "address_info": {
                        "address": "cx3iotaZqweMa7bABi4bRWq6rpponnOIFa",
                        "destination_tag": "4938102"
                    },
                    "created_at": "2020-06-17T20:35:38Z",
                    "updated_at": "2020-06-17T20:35:38Z",
                    "network": "ripple",
                    "resource": "address",
                    "deposit_uri": "xrp:d5rtotadefrga7bABi4bRWq6rpponnOIFa?dt=4938102",
                    "exchange_deposit_address": true
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var CryptoDepositAddressData $coinbaseAccountData */
        $coinbaseAccountData = CryptoDepositAddressData::createFromJson($json);
        self::assertInstanceOf(CryptoDepositAddressData::class, $coinbaseAccountData);
        self::assertEquals('7b147f5d-79de-4d3b-b116-446b259f8765', $coinbaseAccountData->getId());
        self::assertEquals('cx3iotaZqweMa7bABi4bRWq6rpponnOIFa', $coinbaseAccountData->getAddress());
        self::assertEquals('3299925630', $coinbaseAccountData->getDestinationTag());
        $addressInfo = $coinbaseAccountData->getAddressInfo();
        self::assertInstanceOf(CryptoDepositAddressInfoData::class, $addressInfo);
        self::assertEquals('cx3iotaZqweMa7bABi4bRWq6rpponnOIFa', $addressInfo->getAddress());
        self::assertEquals('4938102', $addressInfo->getDestinationTag());
        self::assertEquals(new \DateTime('2020-06-17T20:35:38Z'), $coinbaseAccountData->getCreatedAt());
        self::assertEquals(new \DateTime('2020-06-17T20:35:38Z'), $coinbaseAccountData->getUpdatedAt());
        self::assertEquals('ripple', $coinbaseAccountData->getNetwork());
        self::assertEquals('address', $coinbaseAccountData->getResource());
        self::assertEquals('xrp:cx3iotaZqweMa7bABi4bRWq6rpponnOIFa?dt=4938102', $coinbaseAccountData->getDepositUri());
        self::assertEquals(true, $coinbaseAccountData->isExchangeDepositAddress());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = CryptoDepositAddressData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(CryptoDepositAddressData::class, $value);
        }
    }
}
