<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\HistoricRatesCandlesData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\HistoricRatesCandlesData
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 */
class HistoricRatesCandlesDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '[
                    1601161200,
                    10735,
                    10751.73,
                    10735.02,
                    10741.88,
                    460.48615711
                ]'
            ],
        ];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                [
                    1601161200,
                    10735,
                    10751.73,
                    10735.02,
                    10741.88,
                    460.48615711
                ],
                [
                    1601157600,
                    10710.63,
                    10747.54,
                    10727.2,
                    10735.02,
                    1664.27187949
                ],
                [
                    1601154000,
                    10719,
                    10757.65,
                    10719.02,
                    10727.2,
                    576.03554903
                ],
                [
                    1600560000,
                    11048.1,
                    11082.52,
                    11082.52,
                    11067.25,
                    3.97346015
                ]
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var HistoricRatesCandlesData $historicRatesCandlesData */
        $historicRatesCandlesData = HistoricRatesCandlesData::createFromJson($json);
        self::assertInstanceOf(HistoricRatesCandlesData::class, $historicRatesCandlesData);
        self::assertEquals(1601161200, $historicRatesCandlesData->getStartTime());
        self::assertEquals(10735, $historicRatesCandlesData->getLowestPrice());
        self::assertEquals(10751.73, $historicRatesCandlesData->getHighestPrice());
        self::assertEquals(10735.02, $historicRatesCandlesData->getOpeningPrice());
        self::assertEquals(10741.88, $historicRatesCandlesData->getClosingPrice());
        self::assertEquals(460.48615711, $historicRatesCandlesData->getTradingVolume());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = HistoricRatesCandlesData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(HistoricRatesCandlesData::class, $value);
        }
    }
}
