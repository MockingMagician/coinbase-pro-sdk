<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\OrderData
 *
 * @internal
 */
class OrderDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "id": "9a41a7e0-6b61-496f-9296-041193b758cf",
                    "size": "0.00100000",
                    "product_id": "BTC-USD",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "side": "buy",
                    "funds": "373001.7186515000000000",
                    "type": "market",
                    "post_only": false,
                    "created_at": "2020-09-26T23:09:09.700814Z",
                    "done_at": "2020-09-26T23:09:09.708Z",
                    "done_reason": "filled",
                    "fill_fees": "0.0214856800000000",
                    "filled_size": "0.00100000",
                    "executed_value": "10.7428400000000000",
                    "status": "done",
                    "settled": true
                }',
            ],
            [
                '{
                    "id": "9a41a7e0-6b61-496f-9296-041193b758cf",
                    "price": "0.01",
                    "size": "0.001",
                    "product_id": "BTC-USD",
                    "side": "buy",
                    "stp": "cn",
                    "type": "limit",
                    "time_in_force": "GTC",
                    "post_only": false,
                    "created_at": "2020-09-26T23:09:09.700814Z",
                    "fill_fees": "0",
                    "filled_size": "0",
                    "executed_value": "0",
                    "status": "pending",
                    "settled": false
                }',
            ],
        ];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "id": "9a41a7e0-6b61-496f-9296-041193b758cf",
                    "size": "0.00100000",
                    "product_id": "BTC-USD",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "side": "buy",
                    "funds": "373001.7186515000000000",
                    "type": "market",
                    "post_only": false,
                    "created_at": "2020-09-26T23:09:09.700814Z",
                    "done_at": "2020-09-26T23:09:09.708Z",
                    "done_reason": "filled",
                    "fill_fees": "0.0214856800000000",
                    "filled_size": "0.00100000",
                    "executed_value": "10.7428400000000000",
                    "status": "done",
                    "settled": true
                },
                {
                    "id": "98bd1183-507c-4a43-8c08-c43f2a35197c",
                    "price": "0.01000000",
                    "size": "0.00100000",
                    "product_id": "BTC-USD",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "side": "buy",
                    "type": "limit",
                    "time_in_force": "GTC",
                    "post_only": false,
                    "created_at": "2020-09-26T23:09:09.257189Z",
                    "fill_fees": "0.0000000000000000",
                    "filled_size": "0.00000000",
                    "executed_value": "0.0000000000000000",
                    "status": "open",
                    "settled": false
                },
                {
                    "id": "6c1e0217-63d5-47d1-a7a0-a0a34f9c70bf",
                    "price": "0.01000000",
                    "size": "0.00100000",
                    "product_id": "BTC-USD",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "side": "buy",
                    "type": "limit",
                    "time_in_force": "GTC",
                    "post_only": false,
                    "created_at": "2020-09-26T23:09:07.637976Z",
                    "fill_fees": "0.0000000000000000",
                    "filled_size": "0.00000000",
                    "executed_value": "0.0000000000000000",
                    "status": "open",
                    "settled": false
                },
                {
                    "id": "4390440a-e2f1-4ad4-ba80-e2b1bac688e7",
                    "price": "0.01000000",
                    "size": "0.00100000",
                    "product_id": "BTC-USD",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "side": "buy",
                    "type": "limit",
                    "time_in_force": "GTC",
                    "post_only": false,
                    "created_at": "2020-09-26T23:09:05.940177Z",
                    "fill_fees": "0.0000000000000000",
                    "filled_size": "0.00000000",
                    "executed_value": "0.0000000000000000",
                    "status": "open",
                    "settled": false
                },
                {
                    "id": "f6d2f589-e54e-40e5-b8de-95e7b9ae0e9d",
                    "price": "0.01000000",
                    "size": "0.00100000",
                    "product_id": "BTC-USD",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "side": "buy",
                    "type": "limit",
                    "time_in_force": "GTC",
                    "post_only": false,
                    "created_at": "2020-09-26T23:09:02.848882Z",
                    "fill_fees": "0.0000000000000000",
                    "filled_size": "0.00000000",
                    "executed_value": "0.0000000000000000",
                    "status": "open",
                    "settled": false
                },
                {
                    "id": "82601f88-a2e3-494f-954b-50f8bc281d95",
                    "size": "0.00100000",
                    "product_id": "BTC-USD",
                    "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                    "side": "buy",
                    "funds": "372996.4591915000000000",
                    "type": "market",
                    "post_only": false,
                    "created_at": "2020-09-26T23:08:58.847238Z",
                    "done_at": "2020-09-26T23:08:58.855Z",
                    "done_reason": "filled",
                    "fill_fees": "0.0214810200000000",
                    "filled_size": "0.00100000",
                    "executed_value": "10.7405100000000000",
                    "status": "done",
                    "settled": true
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var OrderData $orderData */
        $orderData = OrderData::createFromJson($json);
        self::assertInstanceOf(OrderData::class, $orderData);
        self::assertEquals('9a41a7e0-6b61-496f-9296-041193b758cf', $orderData->getId());
        self::assertNullOrEquals(0.01, $orderData->getPrice());
        self::assertEquals(0.001, $orderData->getSize());
        self::assertNullOrEquals('cn', $orderData->getSelfTradePrevention());
        self::assertEquals('BTC-USD', $orderData->getProductId());
        self::assertNullOrEquals('d9313ff2-2ef2-4f4d-a310-65b5143fde3f', $orderData->getProfileId());
        self::assertEquals('buy', $orderData->getSide());
        self::assertNullOrEquals(373001.7186515, $orderData->getFunds());
        self::assertEqualsOneOf(['market', 'limit'], $orderData->getType());
        self::assertNullOrEquals('GTC', $orderData->getTimeInForce());
        self::assertNullOrEquals(false, $orderData->isPostOnly());
        self::assertEquals(new \DateTime('2020-09-26T23:09:09.700814Z'), $orderData->getCreatedAt());
        self::assertNullOrEquals(new \DateTime('2020-09-26T23:09:09.708Z'), $orderData->getDoneAt());
        self::assertNullOrEquals('filled', $orderData->getDoneReason());
        self::assertEqualsOneOf([0, 0.02148568], $orderData->getFillFees());
        self::assertEqualsOneOf([0, 0.001], $orderData->getFilledSize());
        self::assertEqualsOneOf([0, 10.74284], $orderData->getExecutedValue());
        self::assertEqualsOneOf(['done', 'pending'], $orderData->getStatus());
        self::assertIsBool($orderData->isSettled());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = OrderData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(OrderData::class, $value);
        }
    }
}
