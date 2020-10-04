<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderBookData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderBookDetailsData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\OrderBookData
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\OrderBookDetailsData
 *
 * @internal
 */
class OrderBookDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "bids": [
                        [
                            "0.07",
                            "1.12",
                            1
                        ]
                    ],
                    "asks": [
                        [
                            "0.0976",
                            "0.97",
                            1
                        ]
                    ],
                    "sequence": 4597337
                }',
            ],
        ];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var OrderBookData $orderBookData */
        $orderBookData = OrderBookData::createFromJson($json);
        self::assertInstanceOf(OrderBookData::class, $orderBookData);
        self::assertEquals(4597337, $orderBookData->getSequence());
        $bids = $orderBookData->getBids();
        $asks = $orderBookData->getAsks();
        foreach ($bids as $bid) {
            self::assertInstanceOf(OrderBookDetailsData::class, $bid);
            self::assertEquals(0.07, $bid->getPrice());
            self::assertEquals(1.12, $bid->getSize());
            self::assertEquals(1, $bid->getNumOrders());
            self::assertEquals(null, $bid->getOrderId());
        }
        foreach ($asks as $ask) {
            self::assertInstanceOf(OrderBookDetailsData::class, $ask);
            self::assertEquals(0.0976, $ask->getPrice());
            self::assertEquals(0.97, $ask->getSize());
            self::assertEquals(1, $ask->getNumOrders());
            self::assertEquals(null, $ask->getOrderId());
        }
    }
}
