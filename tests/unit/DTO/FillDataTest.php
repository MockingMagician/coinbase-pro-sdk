<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\FillData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\FillData
 *
 * @internal
 */
class FillDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "created_at": "2020-09-26T21:14:52.938Z",
                    "trade_id": 15826695,
                    "product_id": "BTC-USD",
                    "order_id": "163bcb8e-da5d-4b72-9042-f710ecba7fc0",
                    "user_id": "5e70d9c2371d9322ba7d99f5",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "liquidity": "T",
                    "price": "10728.58000000",
                    "size": "0.00100000",
                    "fee": "0.0214571600000000",
                    "side": "buy",
                    "settled": true,
                    "usd_volume": "10.7285800000000000"
                }',
            ],
            [
                '{
                    "trade_id": 15826695,
                    "product_id": "BTC-USD",
                    "price": "10728.58000000",
                    "size": "0.00100000",
                    "order_id": "163bcb8e-da5d-4b72-9042-f710ecba7fc0",
                    "created_at": "2020-09-26T21:14:52.938Z",
                    "liquidity": "T",
                    "fee": "0.0214571600000000",
                    "settled": true,
                    "side": "buy"
                }',
            ],
        ];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "created_at": "2020-09-26T21:14:52.938Z",
                    "trade_id": 15826695,
                    "product_id": "BTC-USD",
                    "order_id": "163bcb8e-da5d-4b72-9042-f710ecba7fc0",
                    "user_id": "5e70d9c2371d9322ba7d99f5",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "liquidity": "T",
                    "price": "10728.58000000",
                    "size": "0.00100000",
                    "fee": "0.0214571600000000",
                    "side": "buy",
                    "settled": true,
                    "usd_volume": "10.7285800000000000"
                },
                {
                    "created_at": "2020-09-24T18:55:34.364Z",
                    "trade_id": 15776933,
                    "product_id": "BTC-USD",
                    "order_id": "9c36925d-479a-4700-bc30-6102dd8c978c",
                    "user_id": "5e70d9c2371d9322ba7d99f5",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "liquidity": "T",
                    "price": "10625.01000000",
                    "size": "0.00100000",
                    "fee": "0.0212500200000000",
                    "side": "buy",
                    "settled": true,
                    "usd_volume": "10.6250100000000000"
                },
                {
                    "trade_id": 74,
                    "product_id": "BTC-USD",
                    "price": "10.00",
                    "size": "0.01",
                    "order_id": "d50ec984-77a8-460a-b958-66f114b0de9b",
                    "created_at": "2014-11-07T22:19:28.578544Z",
                    "liquidity": "T",
                    "fee": "0.00025",
                    "settled": true,
                    "side": "buy"
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var FillData $fillData */
        $fillData = FillData::createFromJson($json);
        self::assertInstanceOf(FillData::class, $fillData);
        self::assertEquals(new \DateTime('2020-09-26T21:14:52.938Z'), $fillData->getCreatedAt());
        self::assertEquals(15826695, $fillData->getTradeId());
        self::assertEquals('BTC-USD', $fillData->getProductId());
        self::assertEquals('163bcb8e-da5d-4b72-9042-f710ecba7fc0', $fillData->getOrderId());
        self::assertNullOrEquals('5e70d9c2371d9322ba7d99f5', $fillData->getUserId());
        self::assertNullOrEquals('d9313ff2-2ef2-4f4d-a310-65b5143fde3f', $fillData->getProfileId());
        self::assertEquals('T', $fillData->getLiquidity());
        self::assertEquals(10728.58, $fillData->getPrice());
        self::assertEquals(0.001, $fillData->getSize());
        self::assertEquals(0.02145716, $fillData->getFee());
        self::assertEquals('buy', $fillData->getSide());
        self::assertIsBool($fillData->isSettled());
        self::assertNullOrEquals(10.72858, $fillData->getUsdVolume());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = FillData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(FillData::class, $value);
        }
    }
}
