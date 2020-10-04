<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\HoldData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\HoldData
 *
 * @internal
 */
class HoldDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "id": "82dcd140-c3c7-4507-8de4-2c529cd1a28f",
                    "account_id": "e0b3f39a-183d-453e-b754-0c13e5bab0b3",
                    "created_at": "2014-11-06T10:34:47.123456Z",
                    "updated_at": "2014-11-06T10:40:47.123456Z",
                    "amount": "4.23",
                    "type": "order",
                    "ref": "0a205de4-dd35-4370-a285-fe8fc375a273"
                }',
            ],
        ];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "id": "82dcd140-c3c7-4507-8de4-2c529cd1a28f",
                    "account_id": "e0b3f39a-183d-453e-b754-0c13e5bab0b3",
                    "created_at": "2014-11-06T10:34:47.123456Z",
                    "updated_at": "2014-11-06T10:40:47.123456Z",
                    "amount": "4.23",
                    "type": "order",
                    "ref": "0a205de4-dd35-4370-a285-fe8fc375a273"
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var HoldData $holdData */
        $holdData = HoldData::createFromJson($json);
        self::assertInstanceOf(HoldData::class, $holdData);
        self::assertEquals('82dcd140-c3c7-4507-8de4-2c529cd1a28f', $holdData->getId());
        self::assertEquals('e0b3f39a-183d-453e-b754-0c13e5bab0b3', $holdData->getAccountId());
        self::assertEquals(new \DateTime('2014-11-06T10:34:47.123456Z'), $holdData->getCreatedAt());
        self::assertEquals(new \DateTime('2014-11-06T10:40:47.123456Z'), $holdData->getUpdatedAt());
        self::assertEquals(4.23, $holdData->getAmount());
        self::assertEquals('order', $holdData->getType());
        self::assertEquals('0a205de4-dd35-4370-a285-fe8fc375a273', $holdData->getRef());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = HoldData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(HoldData::class, $value);
        }
    }
}
