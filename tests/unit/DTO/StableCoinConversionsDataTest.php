<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderBookData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderBookDetailsData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ProductStats24hrData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\StableCoinConversionsData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\StableCoinConversionsData
 *
 * @internal
 */
class StableCoinConversionsDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "id": "bd0bf003-cbdb-4be1-9d14-2611563f3f3f",
                    "amount": "15.00000000",
                    "from_account_id": "60b752df-0e87-40ec-b252-37533eadcb92",
                    "to_account_id": "e56a8c0e-8e5e-48a3-8ffa-83694e84cc0d",
                    "from": "USD",
                    "to": "USDC"
                }',
            ],
        ];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var StableCoinConversionsData $stableCoinConversionsData */
        $stableCoinConversionsData = StableCoinConversionsData::createFromJson($json);
        self::assertInstanceOf(StableCoinConversionsData::class, $stableCoinConversionsData);
        self::assertEquals('bd0bf003-cbdb-4be1-9d14-2611563f3f3f', $stableCoinConversionsData->getId());
        self::assertEquals(15, $stableCoinConversionsData->getAmount());
        self::assertEquals('60b752df-0e87-40ec-b252-37533eadcb92', $stableCoinConversionsData->getFromAccountId());
        self::assertEquals('e56a8c0e-8e5e-48a3-8ffa-83694e84cc0d', $stableCoinConversionsData->getToAccountId());
        self::assertEquals('USD', $stableCoinConversionsData->getFromCurrencyId());
        self::assertEquals('USDC', $stableCoinConversionsData->getToCurrencyId());
    }
}
