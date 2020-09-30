<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ProductData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\ProductData
 *
 * @internal
 */
class ProductDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "id": "LINK-USDC",
                    "base_currency": "LINK",
                    "quote_currency": "USDC",
                    "base_min_size": "1.00000000",
                    "base_max_size": "800000.00000000",
                    "quote_increment": "0.00000100",
                    "base_increment": "1.00000000",
                    "display_name": "LINK\/USDC",
                    "min_market_funds": "10",
                    "max_market_funds": "100000",
                    "margin_enabled": false,
                    "post_only": false,
                    "limit_only": false,
                    "cancel_only": false,
                    "trading_disabled": false,
                    "status": "online",
                    "status_message": "some message"
                }',
            ],
        ];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "id": "LINK-USDC",
                    "base_currency": "LINK",
                    "quote_currency": "USDC",
                    "base_min_size": "1.00000000",
                    "base_max_size": "800000.00000000",
                    "quote_increment": "0.00000100",
                    "base_increment": "1.00000000",
                    "display_name": "LINK\/USDC",
                    "min_market_funds": "10",
                    "max_market_funds": "100000",
                    "margin_enabled": false,
                    "post_only": false,
                    "limit_only": false,
                    "cancel_only": false,
                    "trading_disabled": false,
                    "status": "online",
                    "status_message": ""
                },
                {
                    "id": "BTC-EUR",
                    "base_currency": "BTC",
                    "quote_currency": "EUR",
                    "base_min_size": "0.00100000",
                    "base_max_size": "10000.00000000",
                    "quote_increment": "0.01000000",
                    "base_increment": "0.00000001",
                    "display_name": "BTC\/EUR",
                    "min_market_funds": "10",
                    "max_market_funds": "600000",
                    "margin_enabled": false,
                    "post_only": false,
                    "limit_only": false,
                    "cancel_only": false,
                    "trading_disabled": false,
                    "status": "online",
                    "status_message": ""
                },
                {
                    "id": "BAT-USDC",
                    "base_currency": "BAT",
                    "quote_currency": "USDC",
                    "base_min_size": "1.00000000",
                    "base_max_size": "300000.00000000",
                    "quote_increment": "0.00000100",
                    "base_increment": "0.00000100",
                    "display_name": "BAT\/USDC",
                    "min_market_funds": "1",
                    "max_market_funds": "100000",
                    "margin_enabled": false,
                    "post_only": false,
                    "limit_only": false,
                    "cancel_only": false,
                    "trading_disabled": false,
                    "status": "online",
                    "status_message": ""
                },
                {
                    "id": "BTC-USD",
                    "base_currency": "BTC",
                    "quote_currency": "USD",
                    "base_min_size": "0.00100000",
                    "base_max_size": "10000.00000000",
                    "quote_increment": "0.01000000",
                    "base_increment": "0.00000001",
                    "display_name": "BTC\/USD",
                    "min_market_funds": "10",
                    "max_market_funds": "1000000",
                    "margin_enabled": true,
                    "post_only": false,
                    "limit_only": false,
                    "cancel_only": false,
                    "trading_disabled": false,
                    "status": "online",
                    "status_message": ""
                },
                {
                    "id": "BTC-GBP",
                    "base_currency": "BTC",
                    "quote_currency": "GBP",
                    "base_min_size": "0.00100000",
                    "base_max_size": "10000.00000000",
                    "quote_increment": "0.01000000",
                    "base_increment": "0.00000001",
                    "display_name": "BTC\/GBP",
                    "min_market_funds": "10",
                    "max_market_funds": "200000",
                    "margin_enabled": false,
                    "post_only": false,
                    "limit_only": false,
                    "cancel_only": false,
                    "trading_disabled": false,
                    "status": "online",
                    "status_message": ""
                },
                {
                    "id": "ETH-BTC",
                    "base_currency": "ETH",
                    "quote_currency": "BTC",
                    "base_min_size": "0.01000000",
                    "base_max_size": "1000000.00000000",
                    "quote_increment": "0.00001000",
                    "base_increment": "0.00000001",
                    "display_name": "ETH\/BTC",
                    "min_market_funds": "0.001",
                    "max_market_funds": "80",
                    "margin_enabled": false,
                    "post_only": false,
                    "limit_only": false,
                    "cancel_only": false,
                    "trading_disabled": false,
                    "status": "online",
                    "status_message": ""
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var ProductData $productData */
        $productData = ProductData::createFromJson($json);
        self::assertInstanceOf(ProductData::class, $productData);
        self::assertEquals('LINK-USDC', $productData->getId());
        self::assertEquals('LINK', $productData->getBaseCurrency());
        self::assertEquals('USDC', $productData->getQuoteCurrency());
        self::assertEquals(1, $productData->getBaseMinSize());
        self::assertEquals(800000, $productData->getBaseMaxSize());
        self::assertEquals(0.000001, $productData->getQuoteIncrement());
        self::assertEquals(1, $productData->getBaseIncrement());
        self::assertEquals('LINK/USDC', $productData->getDisplayName());
        self::assertEquals(10, $productData->getMinMarketFunds());
        self::assertEquals(100000, $productData->getMaxMarketFunds());
        self::assertEquals(false, $productData->isMarginEnabled());
        self::assertEquals(false, $productData->isPostOnly());
        self::assertEquals(false, $productData->isLimitOnly());
        self::assertEquals(false, $productData->isCancelOnly());
        self::assertEquals(false, $productData->isTradingDisabled());
        self::assertEquals('online', $productData->getStatus());
        self::assertEquals('some message', $productData->getStatusMessage());
    }

    private function generatePartialMockForIsFullyOperational(
        bool $isPostOnly,
        bool $isLimitOnly,
        bool $isCancelOnly,
        bool $isTradingDisabled
    )
    {
        $productData = $this->createPartialMock(ProductData::class, [
            'isPostOnly',
            'isLimitOnly',
            'isCancelOnly',
            'isTradingDisabled',
        ]);

        $productData->method('isPostOnly')->willReturn($isPostOnly);
        $productData->method('isLimitOnly')->willReturn($isLimitOnly);
        $productData->method('isCancelOnly')->willReturn($isCancelOnly);
        $productData->method('isTradingDisabled')->willReturn($isTradingDisabled);

        return $productData;
    }

    public function testTradingIsFullyOperational()
    {
        $productData = $this->generatePartialMockForIsFullyOperational(
            false,
            false,
            false,
            false
        );

        self::assertTrue($productData->isTradingFullyOperational());

        $productData = $this->generatePartialMockForIsFullyOperational(
            true,
            false,
            false,
            false
        );

        self::assertFalse($productData->isTradingFullyOperational());

        $productData = $this->generatePartialMockForIsFullyOperational(
            false,
            true,
            false,
            false
        );

        self::assertFalse($productData->isTradingFullyOperational());

        $productData = $this->generatePartialMockForIsFullyOperational(
            false,
            false,
            true,
            false
        );

        self::assertFalse($productData->isTradingFullyOperational());

        $productData = $this->generatePartialMockForIsFullyOperational(
            false,
            false,
            false,
            true
        );

        self::assertFalse($productData->isTradingFullyOperational());
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = ProductData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(ProductData::class, $value);
        }
    }
}
