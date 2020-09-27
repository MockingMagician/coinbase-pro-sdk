<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\CryptoDepositAddressData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CryptoDepositAddressInfoData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

class CryptoDepositAddressDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "id": "7b147f5d-79de-4d3b-b116-446b259f8765",
                    "address": "cx3iotaZqweMa7bABi4bRWq6rpponnOIFa",
                    "destination_tag": "3299925630",
                    "address_info": {
                        "address": "cx3iotaZqweMa7bABi4bRWq6rpponnOIFa",
                        "destination_tag": "4938102"
                    },
                    "created_at": "2014-05-07T08:41:19-07:00",
                    "updated_at": "2014-05-07T08:41:19-08:00",
                    "network": "ripple",
                    "resource": "address",
                    "deposit_uri": "xrp:cx3iotaZqweMa7bABi4bRWq6rpponnOIFa?dt=4938102",
                    "exchange_deposit_address": true
                }',
            ],
            [
                '{
                    "id": "7b147f5d-79de-4d3b-b116-446b259f8765",
                    "address": "cx3iotaZqweMa7bABi4bRWq6rpponnOIFa",
                    "name": "New exchange deposit address",
                    "callback_url": null,
                    "created_at": "2014-05-07T08:41:19-07:00",
                    "updated_at": "2014-05-07T08:41:19-08:00",
                    "resource": "address",
                    "resource_path": "\/v2\/exchange\/accounts\/95671473-4dda-5264-a654-fc6923e8a334\/addresses\/dd3183eb-af1d-5f5d-a90d-cbff946435ff",
                    "exchange_deposit_address": true
                }',
            ],
        ];
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
                    "created_at": "2014-05-07T08:41:19-07:00",
                    "updated_at": "2014-05-07T08:41:19-08:00",
                    "network": "ripple",
                    "resource": "address",
                    "deposit_uri": "xrp:cx3iotaZqweMa7bABi4bRWq6rpponnOIFa?dt=4938102",
                    "exchange_deposit_address": true
                },
                {
                    "id": "7b147f5d-79de-4d3b-b116-446b259f8765",
                    "address": "cx3iotaZqweMa7bABi4bRWq6rpponnOIFa",
                    "name": "New exchange deposit address",
                    "callback_url": null,
                    "created_at": "2014-05-07T08:41:19-07:00",
                    "updated_at": "2014-05-07T08:41:19-08:00",
                    "resource": "address",
                    "resource_path": "\/v2\/exchange\/accounts\/95671473-4dda-5264-a654-fc6923e8a334\/addresses\/dd3183eb-af1d-5f5d-a90d-cbff946435ff",
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
        self::assertNullOrEquals('3299925630', $coinbaseAccountData->getDestinationTag());
        $addressInfo = $coinbaseAccountData->getAddressInfo();
        self::assertNullOrInstanceOf(CryptoDepositAddressInfoData::class, $addressInfo);
        if ($addressInfo) {
            self::assertEquals('cx3iotaZqweMa7bABi4bRWq6rpponnOIFa', $addressInfo->getAddress());
            self::assertEquals('4938102', $addressInfo->getDestinationTag());
        }
        self::assertEquals(new \DateTime('2014-05-07T08:41:19-07:00'), $coinbaseAccountData->getCreatedAt());
        self::assertEquals(new \DateTime('2014-05-07T08:41:19-08:00'), $coinbaseAccountData->getUpdatedAt());
        self::assertNullOrEquals('ripple', $coinbaseAccountData->getNetwork());
        self::assertEquals('address', $coinbaseAccountData->getResource());
        self::assertNullOrEquals('xrp:cx3iotaZqweMa7bABi4bRWq6rpponnOIFa?dt=4938102', $coinbaseAccountData->getDepositUri());
        self::assertEquals(true, $coinbaseAccountData->isExchangeDepositAddress());
        self::assertNullOrEquals('https://some-url.com', $coinbaseAccountData->getCallbackUrl());
        self::assertNullOrEquals('/v2/exchange/accounts/95671473-4dda-5264-a654-fc6923e8a334/addresses/dd3183eb-af1d-5f5d-a90d-cbff946435ff', $coinbaseAccountData->getResourcePath());
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
