<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\HoldData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ProfileData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\ProfileData
 *
 * @internal
 */
class ProfileDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "user_id": "5e70d9c2371d9322ba7d99f5",
                    "name": "default",
                    "active": true,
                    "is_default": true,
                    "created_at": "2020-09-04T11:28:29.643947Z"
                }',
            ],
        ];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "user_id": "5e70d9c2371d9322ba7d99f5",
                    "name": "default",
                    "active": true,
                    "is_default": true,
                    "created_at": "2020-09-04T11:28:29.643947Z"
                },
                {
                    "id": "6ad32444-8367-4340-8360-ed7c87d72491",
                    "user_id": "5e70d9c2371d9322ba7d99f5",
                    "name": "New one",
                    "active": true,
                    "is_default": false,
                    "created_at": "2020-09-04T12:14:28.454481Z"
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var ProfileData $holdData */
        $holdData = ProfileData::createFromJson($json);
        self::assertInstanceOf(ProfileData::class, $holdData);
        self::assertEquals('d9313ff2-2ef2-4f4d-a310-65b5143fde3f', $holdData->getId());
        self::assertEquals('5e70d9c2371d9322ba7d99f5', $holdData->getUserId());
        self::assertEquals('default', $holdData->getName());
        self::assertEquals(true, $holdData->isActive());
        self::assertEquals(true, $holdData->isDefault());
        self::assertEquals(new \DateTime('2020-09-04T11:28:29.643947Z'), $holdData->getCreatedAt());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = ProfileData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(ProfileData::class, $value);
        }
    }
}
