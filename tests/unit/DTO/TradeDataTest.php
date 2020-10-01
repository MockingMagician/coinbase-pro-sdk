<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TradeData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\TradeData
 *
 * @internal
 */
class TradeDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "time": "2020-09-26T23:22:26.124Z",
                    "trade_id": 15829729,
                    "price": "10741.88000000",
                    "size": "0.11430000",
                    "side": "sell"
                }',
            ],
        ];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "time": "2020-09-26T23:22:26.124Z",
                    "trade_id": 15829729,
                    "price": "10741.88000000",
                    "size": "0.11430000",
                    "side": "sell"
                },
                {
                    "time": "2020-09-26T23:22:25.549Z",
                    "trade_id": 15829728,
                    "price": "10741.88000000",
                    "size": "0.01870000",
                    "side": "sell"
                },
                {
                    "time": "2020-09-26T23:22:24.922Z",
                    "trade_id": 15829727,
                    "price": "10741.88000000",
                    "size": "0.21400000",
                    "side": "sell"
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var TradeData $tradeData */
        $tradeData = TradeData::createFromJson($json);
        self::assertInstanceOf(TradeData::class, $tradeData);
        self::assertEquals(new \DateTime('2020-09-26T23:22:26.124Z'), $tradeData->getTime());
        self::assertEquals(15829729, $tradeData->getTradeId());
        self::assertEquals(10741.88, $tradeData->getPrice());
        self::assertEquals(0.1143, $tradeData->getSize());
        self::assertEquals('sell', $tradeData->getSide());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = TradeData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(TradeData::class, $value);
        }
    }
}
