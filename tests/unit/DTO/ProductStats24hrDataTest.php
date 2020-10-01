<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\ProductStats24hrData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\ProductStats24hrData
 *
 * @internal
 */
class ProductStats24hrDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "open": "100",
                    "high": "112",
                    "low": "98",
                    "volume": "2154.4895",
                    "last": "103",
                    "volume_30day": "67258.581187"
                }',
            ],
        ];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var ProductStats24hrData $productStats24hrData */
        $productStats24hrData = ProductStats24hrData::createFromJson($json);
        self::assertInstanceOf(ProductStats24hrData::class, $productStats24hrData);
        self::assertEquals(100, $productStats24hrData->getOpen());
        self::assertEquals(112, $productStats24hrData->getHigh());
        self::assertEquals(98, $productStats24hrData->getLow());
        self::assertEquals(2154.4895, $productStats24hrData->getVolume());
        self::assertEquals(103, $productStats24hrData->getLast());
        self::assertEquals(67258.581187, $productStats24hrData->getVolume30day());
    }
}
