<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\FillData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\MarginStatusData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\MarginStatusData
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 */
class MarginStatusTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "eligible": false,
                    "tier": 0,
                    "enabled": false
                }'
            ],
        ];
    }


    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var MarginStatusData $marginStatusData */
        $marginStatusData = MarginStatusData::createFromJson($json);
        self::assertInstanceOf(MarginStatusData::class, $marginStatusData);
        self::assertEquals(false, $marginStatusData->isEligible());
        self::assertEquals(0, $marginStatusData->getTier());
        self::assertEquals(false, $marginStatusData->isEnabled());
    }
}
