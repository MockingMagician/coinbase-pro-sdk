<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\AccountData;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AccountData
 *
 * @internal
 */
class AccountDataTest extends TestCase
{
    public function provideValidJsonData()
    {
        return [[
            '{
                "id": "18ba201e-6241-4efb-9b89-ed2885954566",
                "currency": "BAT",
                "balance": "1455.0000000000000000",
                "hold": "0.0000000000000000",
                "available": "1455",
                "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                "trading_enabled": true
            }',
        ]];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "id": "18ba201e-6241-4efb-9b89-ed2885954566",
                    "currency": "BAT",
                    "balance": "1455.0000000000000000",
                    "hold": "0.0000000000000000",
                    "available": "1455",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "trading_enabled": true
                },
                {
                    "id": "2ac4ec8e-1349-4fc4-95dd-236a5ab4deb9",
                    "currency": "BTC",
                    "balance": "544.1565877400000000",
                    "hold": "0.0000000000000000",
                    "available": "544.15658774",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "trading_enabled": true
                },
                {
                    "id": "d2fca8ca-f913-4b28-bb81-cd705c4bc348",
                    "currency": "ETH",
                    "balance": "1460.0000000000000000",
                    "hold": "0.0000000000000000",
                    "available": "1460",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "trading_enabled": true
                },
                {
                    "id": "f39bff40-6a2e-44e9-974d-fffd515e7144",
                    "currency": "EUR",
                    "balance": "166619.6023638250000000",
                    "hold": "0.0000000000000000",
                    "available": "166619.602363825",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "trading_enabled": true
                },
                {
                    "id": "e47a1cdf-b458-4824-abef-26910901eb18",
                    "currency": "GBP",
                    "balance": "1215.0000439915398000",
                    "hold": "0.0000000000000000",
                    "available": "1215.0000439915398",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "trading_enabled": true
                },
                {
                    "id": "619bc976-c6a5-4d3a-9c69-031ff2f0e46a",
                    "currency": "LINK",
                    "balance": "1445.0000000000000000",
                    "hold": "0.0000000000000000",
                    "available": "1445",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "trading_enabled": true
                },
                {
                    "id": "60b752df-0e87-40ec-b252-37533eadcb92",
                    "currency": "USD",
                    "balance": "377846.4842685490670000",
                    "hold": "3911.0320100200000000",
                    "available": "373935.452258529067",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "trading_enabled": true
                },
                {
                    "id": "e56a8c0e-8e5e-48a3-8ffa-83694e84cc0d",
                    "currency": "USDC",
                    "balance": "1575.0000000000000000",
                    "hold": "0.0000000000000000",
                    "available": "1575",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "trading_enabled": true
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var AccountData $account */
        $account = AccountData::createFromJson($json);
        self::assertInstanceOf(AccountData::class, AccountData::createFromJson($json));
        self::assertEquals('18ba201e-6241-4efb-9b89-ed2885954566', $account->getId());
        self::assertEquals('BAT', $account->getCurrency());
        self::assertEquals(1455, $account->getBalance());
        self::assertEquals(0, $account->getHoldFunds());
        self::assertEquals(1455, $account->getAvailableFunds());
        self::assertEquals('d9313ff2-2ef2-4f4d-a310-65b5143fde3f', $account->getProfileId());
        self::assertEquals(true, $account->isTradingEnabled());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = AccountData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(AccountData::class, $value);
        }
    }
}
