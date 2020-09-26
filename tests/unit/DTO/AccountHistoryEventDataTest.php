<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\AccountHistoryEventData;
use PHPUnit\Framework\TestCase;

class AccountHistoryEventDataTest extends TestCase
{
    public function provideValidJsonData()
    {
        return [[
             '{
                  "id": "154612730",
                  "amount": "5.0000000000000000",
                  "balance": "1455.0000000000000000",
                  "created_at": "2020-09-26T15:14:56.527771Z",
                  "type": "transfer",
                  "details": {
                      "transfer_id": "bbdfbc16-8032-42fe-a8c0-fd91cdf7838f",
                      "transfer_type": "deposit"
                  }
              }',
        ]];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "id": "154612730",
                    "amount": "5.0000000000000000",
                    "balance": "1455.0000000000000000",
                    "created_at": "2020-09-26T15:14:56.527771Z",
                    "type": "transfer",
                    "details": {
                        "transfer_id": "bbdfbc16-8032-42fe-a8c0-fd91cdf7838f",
                        "transfer_type": "deposit"
                    }
                },
                {
                    "id": "154612707",
                    "amount": "5.0000000000000000",
                    "balance": "1450.0000000000000000",
                    "created_at": "2020-09-26T15:14:54.993009Z",
                    "type": "transfer",
                    "details": {
                        "transfer_id": "e2deca16-2d40-4698-b6a8-a7fb26810aef",
                        "transfer_type": "deposit"
                    }
                },
                {
                    "id": "154610795",
                    "amount": "5.0000000000000000",
                    "balance": "1445.0000000000000000",
                    "created_at": "2020-09-26T15:09:54.35259Z",
                    "type": "transfer",
                    "details": {
                        "transfer_id": "a47e5066-75f7-494b-a51e-88f76199f252",
                        "transfer_type": "deposit"
                    }
                },
                {
                    "id": "154610782",
                    "amount": "5.0000000000000000",
                    "balance": "1440.0000000000000000",
                    "created_at": "2020-09-26T15:09:52.775821Z",
                    "type": "transfer",
                    "details": {
                        "transfer_id": "7410865a-17a7-43f9-9165-f14aff4b2ac0",
                        "transfer_type": "deposit"
                    }
                },
                {
                    "id": "154345626",
                    "amount": "5.0000000000000000",
                    "balance": "1435.0000000000000000",
                    "created_at": "2020-09-26T01:09:31.846202Z",
                    "type": "transfer",
                    "details": {
                        "transfer_id": "4725f7ac-cbaa-4eed-bcb9-188eab296109",
                        "transfer_type": "deposit"
                    }
                },
                {
                    "id": "154345600",
                    "amount": "5.0000000000000000",
                    "balance": "1430.0000000000000000",
                    "created_at": "2020-09-26T01:09:26.080797Z",
                    "type": "transfer",
                    "details": {
                        "transfer_id": "b1b519c6-15a8-47b1-8c4d-a7ced182f410",
                        "transfer_type": "deposit"
                    }
                },
                {
                    "id": "154338828",
                    "amount": "5.0000000000000000",
                    "balance": "1425.0000000000000000",
                    "created_at": "2020-09-26T00:35:26.603433Z",
                    "type": "transfer",
                    "details": {
                        "transfer_id": "42bb9f65-4c71-45f5-8497-0c284e58055d",
                        "transfer_type": "deposit"
                    }
                },
                {
                    "id": "154338820",
                    "amount": "5.0000000000000000",
                    "balance": "1420.0000000000000000",
                    "created_at": "2020-09-26T00:35:21.494032Z",
                    "type": "transfer",
                    "details": {
                        "transfer_id": "1b8837a4-b1f5-4543-a85e-8635b1607784",
                        "transfer_type": "deposit"
                    }
                },
                {
                    "id": "154319887",
                    "amount": "5.0000000000000000",
                    "balance": "1415.0000000000000000",
                    "created_at": "2020-09-25T20:57:43.601039Z",
                    "type": "transfer",
                    "details": {
                        "transfer_id": "ca79811b-d8ac-464d-8674-d68a08f9258f",
                        "transfer_type": "deposit"
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
        /** @var AccountHistoryEventData $accountHistoryEvent */
        $accountHistoryEvent = AccountHistoryEventData::createFromJson($json);
        self::assertInstanceOf(AccountHistoryEventData::class, $accountHistoryEvent);

        self::assertEquals('154612730', $accountHistoryEvent->getId());
        self::assertEquals(5, $accountHistoryEvent->getAmount());
        self::assertEquals(1455, $accountHistoryEvent->getBalance());
        self::assertEquals(new \DateTime('2020-09-26T15:14:56.527771Z'), $accountHistoryEvent->getCreatedAt());
        self::assertEquals('transfer', $accountHistoryEvent->getType());
        self::assertEquals([
            "transfer_id" => "bbdfbc16-8032-42fe-a8c0-fd91cdf7838f",
            "transfer_type" => "deposit",
        ], $accountHistoryEvent->getDetails());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = AccountHistoryEventData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(AccountHistoryEventData::class, $value);
        }
    }
}
