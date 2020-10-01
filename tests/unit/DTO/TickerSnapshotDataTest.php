<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderBookData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderBookDetailsData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ProductStats24hrData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\StableCoinConversionsData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TickerSnapshotData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\TickerSnapshotData
 *
 * @internal
 */
class TickerSnapshotDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "trade_id": 15829727,
                    "price": "10741.88",
                    "size": "0.214",
                    "time": "2020-09-26T23:22:24.92294Z",
                    "bid": "10741.86",
                    "ask": "10741.88",
                    "volume": "22678.17009565"
                }',
            ],
        ];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var TickerSnapshotData $tickerSnapshotData */
        $tickerSnapshotData = TickerSnapshotData::createFromJson($json);
        self::assertInstanceOf(TickerSnapshotData::class, $tickerSnapshotData);
        self::assertEquals(15829727, $tickerSnapshotData->getTradeId());
        self::assertEquals(10741.88, $tickerSnapshotData->getPrice());
        self::assertEquals(0.214, $tickerSnapshotData->getSize());
        self::assertEquals(new \DateTime('2020-09-26T23:22:24.92294Z'), $tickerSnapshotData->getTime());
        self::assertEquals(10741.86, $tickerSnapshotData->getBid());
        self::assertEquals(10741.88, $tickerSnapshotData->getAsk());
        self::assertEquals(22678.17009565, $tickerSnapshotData->getVolume());
    }
}
