<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\FeeData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\FeeData
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 */
class FeeDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [[
            '{
                "maker_fee_rate": "0.0010",
                "taker_fee_rate": "0.0020",
                "usd_volume": "648040.15"
            }',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var FeeData $feeData */
        $feeData = FeeData::createFromJson($json);
        self::assertInstanceOf(FeeData::class, $feeData);
        self::assertEquals(0.001, $feeData->getMakerFeeRate());
        self::assertEquals(0.002, $feeData->getTakerFeeRate());
        self::assertEquals(648040.15, $feeData->getUsdVolume());
    }
}
