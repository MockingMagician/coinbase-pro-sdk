<?php


namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderBookDetailsDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Products;

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
        self::assertStringContainsString('"base_min_size":', $raw);
        self::assertStringContainsString('"base_max_size":', $raw);
        self::assertStringContainsString('"min_market_funds":', $raw);
        self::assertStringContainsString('"max_market_funds":', $raw);
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
        self::assertIsFloat($products->getBaseMinSize(), 'BaseMinSize');
        self::assertIsFloat($products->getBaseMaxSize(), 'BaseMaxSize');
        self::assertIsFloat($products->getMinMarketFunds(), 'MinMarketFunds');
        self::assertIsFloat($products->getMaxMarketFunds(), 'MaxMarketFunds');
        self::assertIsString($products->getStatus(), 'Status');
        self::assertIsString($products->getStatusMessage(), 'StatusMessage');
        self::assertIsBool($products->isCancelOnly(), 'CancelOnly');
        self::assertIsBool($products->isLimitOnly(), 'LimitOnly');
        self::assertIsBool($products->isPostOnly(), 'PostOnly');
        self::assertIsBool($products->isTradingEnabled(), 'TradingEnabled');
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
        self::assertStringContainsString('"base_min_size":', $raw);
        self::assertStringContainsString('"base_max_size":', $raw);
        self::assertStringContainsString('"min_market_funds":', $raw);
        self::assertStringContainsString('"max_market_funds":', $raw);
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
        self::assertIsFloat($product->getBaseMinSize(), 'BaseMinSize');
        self::assertIsFloat($product->getBaseMaxSize(), 'BaseMaxSize');
        self::assertIsFloat($product->getMinMarketFunds(), 'MinMarketFunds');
        self::assertIsFloat($product->getMaxMarketFunds(), 'MaxMarketFunds');
        self::assertIsString($product->getStatus(), 'Status');
        self::assertIsString($product->getStatusMessage(), 'StatusMessage');
        self::assertIsBool($product->isCancelOnly(), 'CancelOnly');
        self::assertIsBool($product->isLimitOnly(), 'LimitOnly');
        self::assertIsBool($product->isPostOnly(), 'PostOnly');
        self::assertIsBool($product->isTradingEnabled(), 'TradingEnabled');
    }

    public function testGetProductOrderBookRaw()
    {
        $products = $this->products->getProducts()[0];
        $raw = $this->products->getProductOrderBookRaw($products->getId(), Products::LEVEL_THREE, true);

        var_dump($raw);

        self::assertStringContainsString('"bids":', $raw);
        self::assertStringContainsString('"asks":', $raw);
        self::assertStringContainsString('"sequence":', $raw);
    }

    public function testGetProductOrderBook()
    {
        $products = $this->products->getProducts()[0];
        $productOrderBook = $this->products->getProductOrderBook($products->getId(), Products::LEVEL_THREE, true);

        self::assertIsInt($productOrderBook->getSequence());
        self::assertIsArray($productOrderBook->getBids());
        self::assertIsArray($productOrderBook->getAsks());
        self::assertInstanceOf(OrderBookDetailsDataInterface::class, $productOrderBook->getBids()[0]);
        self::assertInstanceOf(OrderBookDetailsDataInterface::class, $productOrderBook->getAsks()[0]);
    }
}
