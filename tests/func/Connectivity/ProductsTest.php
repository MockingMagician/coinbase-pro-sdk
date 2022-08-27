<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderBookDetailsDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Products;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TradeData;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

/**
 * @internal
 */
class ProductsTest extends AbstractTest
{
    /**
     * @var Products
     */
    private $products;

    public function setUp(): void
    {
        parent::setUp();
        $this->products = new Products($this->requestManager);
    }

    public function testGetProductsRaw()
    {
        $raw = $this->products->getProductsRaw();

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"display_name":', $raw);
        self::assertStringContainsString('"base_currency":', $raw);
        self::assertStringContainsString('"quote_currency":', $raw);
        self::assertStringContainsString('"base_increment":', $raw);
        self::assertStringContainsString('"quote_increment":', $raw);
        self::assertStringContainsString('"status":', $raw);
        self::assertStringContainsString('"status_message":', $raw);
        self::assertStringContainsString('"cancel_only":', $raw);
        self::assertStringContainsString('"limit_only":', $raw);
        self::assertStringContainsString('"post_only":', $raw);
        self::assertStringContainsString('"trading_disabled":', $raw);
    }

    public function testGetProducts()
    {
        $products = $this->products->getProducts()[0];

        self::assertIsString($products->getId(), 'Id');
        self::assertIsString($products->getDisplayName(), 'DisplayName');
        self::assertIsString($products->getBaseCurrency(), 'BaseCurrency');
        self::assertIsString($products->getQuoteCurrency(), 'QuoteCurrency');
        self::assertIsFloat($products->getBaseIncrement(), 'BaseIncrement');
        self::assertIsFloat($products->getQuoteIncrement(), 'QuoteIncrement');
        self::assertIsString($products->getStatus(), 'Status');
        self::assertIsString($products->getStatusMessage(), 'StatusMessage');
        self::assertIsBool($products->isCancelOnly(), 'CancelOnly');
        self::assertIsBool($products->isLimitOnly(), 'LimitOnly');
        self::assertIsBool($products->isPostOnly(), 'PostOnly');
        self::assertIsBool($products->isTradingDisabled(), 'TradingEnabled');
    }

    public function testGetSingleProductsRaw()
    {
        $products = $this->products->getProducts()[0];
        $raw = $this->products->getSingleProductRaw($products->getId());

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"display_name":', $raw);
        self::assertStringContainsString('"base_currency":', $raw);
        self::assertStringContainsString('"quote_currency":', $raw);
        self::assertStringContainsString('"base_increment":', $raw);
        self::assertStringContainsString('"quote_increment":', $raw);
        self::assertStringContainsString('"status":', $raw);
        self::assertStringContainsString('"status_message":', $raw);
        self::assertStringContainsString('"cancel_only":', $raw);
        self::assertStringContainsString('"limit_only":', $raw);
        self::assertStringContainsString('"post_only":', $raw);
        self::assertStringContainsString('"trading_disabled":', $raw);
    }

    public function testGetSingleProducts()
    {
        $products = $this->products->getProducts()[0];
        $product = $this->products->getSingleProduct($products->getId());

        self::assertIsString($product->getId(), 'Id');
        self::assertIsString($product->getDisplayName(), 'DisplayName');
        self::assertIsString($product->getBaseCurrency(), 'BaseCurrency');
        self::assertIsString($product->getQuoteCurrency(), 'QuoteCurrency');
        self::assertIsFloat($product->getBaseIncrement(), 'BaseIncrement');
        self::assertIsFloat($product->getQuoteIncrement(), 'QuoteIncrement');
        self::assertIsString($product->getStatus(), 'Status');
        self::assertIsString($product->getStatusMessage(), 'StatusMessage');
        self::assertIsBool($product->isCancelOnly(), 'CancelOnly');
        self::assertIsBool($product->isLimitOnly(), 'LimitOnly');
        self::assertIsBool($product->isPostOnly(), 'PostOnly');
        self::assertIsBool($product->isTradingDisabled(), 'TradingEnabled');
    }

    public function testGetProductOrderBookRaw()
    {
        $products = $this->products->getProducts();
        foreach ($products as $product) {
            try {
                $raw = $this->products->getProductOrderBookRaw($product->getId());
                break;
            } catch (ApiError $exception) {
                continue;
            }
        }

        if (!isset($raw)) {
            $this->markTestSkipped('Can not be tested');
        }

        self::assertStringContainsString('"bids":', $raw);
        self::assertStringContainsString('"asks":', $raw);
        self::assertStringContainsString('"sequence":', $raw);
    }

    public function testGetProductOrderBook()
    {
        $products = $this->products->getProducts();
        foreach ($products as $product) {
            try {
                $productOrderBook = $this->products->getProductOrderBook($product->getId());
                break;
            } catch (ApiError $exception) {
                continue;
            }
        }

        if (!isset($productOrderBook)) {
            $this->markTestSkipped('Can not be tested');
        }

        self::assertIsInt($productOrderBook->getSequence());
        self::assertIsArray($productOrderBook->getBids());
        self::assertIsArray($productOrderBook->getAsks());
        self::assertInstanceOf(OrderBookDetailsDataInterface::class, $productOrderBook->getBids()[0]);
        self::assertInstanceOf(OrderBookDetailsDataInterface::class, $productOrderBook->getAsks()[0]);
    }

    public function testGetProductTickerRaw()
    {
        $products = $this->products->getProducts();
        foreach ($products as $product) {
            try {
                $raw = $this->products->getProductTickerRaw($product->getId());
                break;
            } catch (ApiError $exception) {
                continue;
            }
        }

        if (!isset($raw)) {
            self::markTestSkipped('Can not be tested');
        }

        self::assertStringContainsString('"trade_id":', $raw);
        self::assertStringContainsString('"price":', $raw);
        self::assertStringContainsString('"size":', $raw);
        self::assertStringContainsString('"bid":', $raw);
        self::assertStringContainsString('"ask":', $raw);
        self::assertStringContainsString('"volume":', $raw);
        self::assertStringContainsString('"time":', $raw);
    }

    public function testGetProductTicker()
    {
        $products = $this->products->getProducts();
        foreach ($products as $product) {
            try {
                $productTicker = $this->products->getProductTicker($product->getId());
                break;
            } catch (ApiError $exception) {
                continue;
            }
        }

        if (!isset($productTicker)) {
            self::markTestSkipped('Can not be tested');
        }

        self::assertIsInt($productTicker->getTradeId());
        self::assertIsFloat($productTicker->getPrice());
        self::assertIsFloat($productTicker->getSize());
        self::assertIsFloat($productTicker->getBid());
        self::assertIsFloat($productTicker->getAsk());
        self::assertIsFloat($productTicker->getVolume());
        self::assertInstanceOf(\DateTimeInterface::class, $productTicker->getTime());
    }

    public function testGetTradesRaw()
    {
        $products = $this->products->getProducts();
        foreach ($products as $product) {
            try {
                $raw = $this->products->getTradesRaw($product->getId());
                if ($raw === '[]') {
                    continue;
                }
                break;
            } catch (ApiError $exception) {
                continue;
            }
        }

        if (!isset($raw)) {
            self::markTestSkipped('Can not be tested');
        }

        self::assertStringContainsString('"time":', $raw);
        self::assertStringContainsString('"trade_id":', $raw);
        self::assertStringContainsString('"price":', $raw);
        self::assertStringContainsString('"size":', $raw);
        self::assertStringContainsString('"side":', $raw);
    }

    public function testGetTrades()
    {
        $products = $this->products->getProducts();
        foreach ($products as $product) {
            try {
                $trades = $this->products->getTrades($product->getId());
                if (!count($trades)) {
                    continue;
                }
                break;
            } catch (ApiError $exception) {
                continue;
            }
        }

        if (!isset($trades)) {
            self::markTestSkipped('Can not be tested');
        }

        self::assertNotCount(0, $trades);
        foreach ($trades as $trade) {
            self::assertInstanceOf(\DateTimeInterface::class, $trade->getTime());
            self::assertIsInt($trade->getTradeId());
            self::assertIsFloat($trade->getPrice());
            self::assertIsFloat($trade->getSize());
            self::assertContains($trade->getSide(), TradeData::SIDES);
        }
    }

    public function testGetHistoricRatesRaw()
    {
        $endTime = new \DateTime();
        $startTime = clone $endTime;
        $startTime->modify('-1 week');
        $raw = $this->products->getHistoricRatesRaw('BTC-USD', $startTime, $endTime, Products::GRANULARITY_HOUR);

        self::assertStringContainsString('[[', $raw);
        self::assertStringContainsString(']]', $raw);
    }

    public function testGetHistoricRates()
    {
        $endTime = new \DateTime();
        $startTime = clone $endTime;
        $startTime->modify('-1 week');
        $product = 'BTC-USD';

        // Testing rate limit (call only once by second)
        $t1 = microtime(true);
        $this->products->getHistoricRates($product, $startTime, $endTime, Products::GRANULARITY_HOUR);
        $historicRates = $this->products->getHistoricRates($product, $startTime, $endTime, Products::GRANULARITY_HOUR);
        $t2 = microtime(true);

        self::assertGreaterThan(1.0, $t2 - $t1);

        self::assertIsInt($historicRates->getGranularity());
        self::assertIsArray($historicRates->getCandles());
        self::assertNotEmpty($historicRates->getCandles());

        $candle = $historicRates->getCandles()[0];

        self::assertIsInt($candle->getStartTime());
        self::assertIsFloat($candle->getLowestPrice());
        self::assertIsFloat($candle->getHighestPrice());
        self::assertIsFloat($candle->getOpeningPrice());
        self::assertIsFloat($candle->getClosingPrice());
        self::assertIsFloat($candle->getTradingVolume());
    }

    public function testGet24hrStatsRaw()
    {
        $products = $this->products->getProducts();
        foreach ($products as $product) {
            try {
                $raw = $this->products->get24hrStatsRaw($product->getId());
                break;
            } catch (ApiError $exception) {
                continue;
            }
        }

        if (!isset($raw)) {
            $this->markTestSkipped('Could not be tested');
        }

        self::assertStringContainsString('"open":', $raw);
        self::assertStringContainsString('"high":', $raw);
        self::assertStringContainsString('"low":', $raw);
        self::assertStringContainsString('"volume":', $raw);
        self::assertStringContainsString('"last":', $raw);
        self::assertStringContainsString('"volume_30day":', $raw);
    }

    public function testGet24hrStats()
    {
        $products = $this->products->getProducts();
        foreach ($products as $product) {
            try {
                $stats24hrData = $this->products->get24hrStats($product->getId());
                break;
            } catch (ApiError $exception) {
                continue;
            }
        }

        if (!isset($stats24hrData)) {
            $this->markTestSkipped('Could not be tested');
        }

        self::assertIsFloat($stats24hrData->getOpen());
        self::assertIsFloat($stats24hrData->getHigh());
        self::assertIsFloat($stats24hrData->getLow());
        self::assertIsFloat($stats24hrData->getVolume());
        self::assertIsFloat($stats24hrData->getLast());
        self::assertIsFloat($stats24hrData->getVolume30day());
    }
}
