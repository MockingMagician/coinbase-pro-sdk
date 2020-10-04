<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\DepositData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\DepositData
 *
 * @internal
 */
class DepositDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [[
            '{
                "id": "bb9a1750-2848-4bab-9240-4c0c5aac2a69",
                "type": "deposit",
                "created_at": "2020-09-26 15:14:56.8849+00",
                "completed_at": "2020-09-26 15:14:56.889263+00",
                "canceled_at": null,
                "processed_at": "2020-09-26 15:14:56.889263+00",
                "account_id": "619bc976-c6a5-4d3a-9c69-031ff2f0e46a",
                "user_id": "5e70d9c2371d9322ba7d99f5",
                "user_nonce": null,
                "amount": "5.00000000",
                "details": {
                    "coinbase_account_id": "95671473-4dda-5264-a654-fc6923e8a358",
                    "coinbase_transaction_id": "507f1f77bcf86cd799439011",
                    "coinbase_payment_method_id": ""
                }
            }',
        ]];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "id": "bb9a1750-2848-4bab-9240-4c0c5aac2a69",
                    "type": "deposit",
                    "created_at": "2020-09-26 15:14:56.8849+00",
                    "completed_at": "2020-09-26 15:14:56.889263+00",
                    "canceled_at": null,
                    "processed_at": "2020-09-26 15:14:56.889263+00",
                    "account_id": "619bc976-c6a5-4d3a-9c69-031ff2f0e46a",
                    "user_id": "5e70d9c2371d9322ba7d99f5",
                    "user_nonce": null,
                    "amount": "5.00000000",
                    "details": {
                        "coinbase_account_id": "95671473-4dda-5264-a654-fc6923e8a358",
                        "coinbase_transaction_id": "507f1f77bcf86cd799439011",
                        "coinbase_payment_method_id": ""
                    }
                },
                {
                    "id": "10a93094-5845-4c28-bdc1-910495ffa9a3",
                    "type": "deposit",
                    "created_at": "2020-09-26 15:14:56.737729+00",
                    "completed_at": "2020-09-26 15:14:56.741846+00",
                    "canceled_at": null,
                    "processed_at": "2020-09-26 15:14:56.741846+00",
                    "account_id": "e47a1cdf-b458-4824-abef-26910901eb18",
                    "user_id": "5e70d9c2371d9322ba7d99f5",
                    "user_nonce": null,
                    "amount": "5.00000000",
                    "details": {
                        "coinbase_account_id": "eafc4cb3-600c-5ba1-b9be-b693e7acce52",
                        "coinbase_transaction_id": "507f1f77bcf86cd799439011",
                        "coinbase_payment_method_id": ""
                    }
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var DepositData $depositData */
        $depositData = DepositData::createFromJson($json);
        self::assertInstanceOf(DepositData::class, $depositData);
        self::assertEquals('bb9a1750-2848-4bab-9240-4c0c5aac2a69', $depositData->getId());
        self::assertEquals('deposit', $depositData->getType());
        self::assertEquals(new \DateTime('2020-09-26 15:14:56.8849+00'), $depositData->getCreatedAt());
        self::assertEquals(new \DateTime('2020-09-26 15:14:56.889263+00'), $depositData->getCompletedAt());
        self::assertEquals(new \DateTime('2020-09-26 15:14:56.889263+00'), $depositData->getProcessedAt());
        self::assertNullOrEquals(new \DateTime(), $depositData->getCanceledAt());
        self::assertEquals('619bc976-c6a5-4d3a-9c69-031ff2f0e46a', $depositData->getAccountId());
        self::assertEquals('5e70d9c2371d9322ba7d99f5', $depositData->getUserId());
        self::assertNullOrEquals(1592624441614, $depositData->getUserNonce());
        self::assertEquals(5, $depositData->getAmount());
        self::assertEquals([
            'coinbase_account_id' => '95671473-4dda-5264-a654-fc6923e8a358',
            'coinbase_transaction_id' => '507f1f77bcf86cd799439011',
            'coinbase_payment_method_id' => '',
        ], $depositData->getDetails());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = DepositData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(DepositData::class, $value);
        }
    }
}
