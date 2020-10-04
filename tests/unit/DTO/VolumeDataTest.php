<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\VolumeData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\VolumeData
 *
 * @internal
 */
class VolumeDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "product_id": "BTC-EUR",
                    "volume": "19.35790000",
                    "exchange_volume": "41273.57170481",
                    "recorded_at": "2020-09-26T00:05:00.000915Z"
                }',
            ],
        ];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "product_id": "BTC-EUR",
                    "volume": "19.35790000",
                    "exchange_volume": "41273.57170481",
                    "recorded_at": "2020-09-26T00:05:00.000915Z"
                },
                {
                    "product_id": "BTC-GBP",
                    "volume": "0.02960151",
                    "exchange_volume": "651.48165587",
                    "recorded_at": "2020-09-26T00:05:00.000915Z"
                },
                {
                    "product_id": "BTC-USD",
                    "volume": "43.46888623",
                    "exchange_volume": "2136137.31503328",
                    "recorded_at": "2020-09-26T00:05:00.000915Z"
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var VolumeData $tradeData */
        $tradeData = VolumeData::createFromJson($json);
        self::assertInstanceOf(VolumeData::class, $tradeData);
        self::assertEquals('BTC-EUR', $tradeData->getProductId());
        self::assertEquals(19.3579, $tradeData->getVolume());
        self::assertEquals(41273.57170481, $tradeData->getExchangeVolume());
        self::assertEquals(new \DateTime('2020-09-26T00:05:00.000915Z'), $tradeData->getRecordedAt());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = VolumeData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(VolumeData::class, $value);
        }
    }
}
