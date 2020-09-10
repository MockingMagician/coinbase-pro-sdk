<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;


use MockingMagician\CoinbaseProSdk\Functional\Build\LimitOrderToPlace;
use MockingMagician\CoinbaseProSdk\Functional\Build\MarketOrderToPlace;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Orders;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Products;

class OrdersTest extends AbstractTest
{
    /**
     * @var Orders
     */
    private $orders;
    /**
     * @var Products
     */
    private $products;

    public function setUp(): void
    {
        parent::setUp();
        $this->orders = new Orders($this->requestManager);
        $this->products = new Products($this->requestManager);
    }

    public function testPlaceOrderRawWithMarketOrder()
    {
        $marketOrder = new MarketOrderToPlace(MarketOrderToPlace::SIDE_BUY, 'BTC-USD', 0.001, null);
        $raw = $this->orders->placeOrderRaw($marketOrder);

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"product_id":', $raw);
        self::assertStringContainsString('"side":', $raw);
        self::assertStringContainsString('"stp":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"post_only":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"fill_fees":', $raw);
        self::assertStringContainsString('"filled_size":', $raw);
        self::assertStringContainsString('"executed_value":', $raw);
        self::assertStringContainsString('"status":', $raw);
        self::assertStringContainsString('"settled":', $raw);
    }

    public function testPlaceOrderRawWithLimitOrder()
    {
        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 8000, 0.001);
        $raw = $this->orders->placeOrderRaw($limitOrderToPlace);

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"price":', $raw);
        self::assertStringContainsString('"product_id":', $raw);
        self::assertStringContainsString('"side":', $raw);
        self::assertStringContainsString('"stp":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"time_in_force":', $raw);
        self::assertStringContainsString('"post_only":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"fill_fees":', $raw);
        self::assertStringContainsString('"filled_size":', $raw);
        self::assertStringContainsString('"executed_value":', $raw);
        self::assertStringContainsString('"status":', $raw);
        self::assertStringContainsString('"settled":', $raw);
    }

    public function testPlaceOrderWithMarketOrder()
    {
        $marketOrder = new MarketOrderToPlace(MarketOrderToPlace::SIDE_BUY, 'BTC-USD', 0.001, null);
        $order = $this->orders->placeOrder($marketOrder);

        self::assertIsString($order->getId());
        self::assertIsFloat($order->getSize());
        self::assertIsFloat($order->getFunds());
        self::assertIsString($order->getProductId());
        self::assertIsString($order->getSide());
        self::assertIsString($order->getSelfTradePrevention());
        self::assertIsString($order->getType());
        self::assertIsBool($order->isPostOnly());
        self::assertInstanceOf(\DateTimeInterface::class, $order->getCreatedAt());
        self::assertIsFloat($order->getFillFees());
        self::assertIsFloat($order->getFilledSize());
        self::assertIsFloat($order->getExecutedValue());
        self::assertIsString($order->getStatus());
        self::assertIsBool($order->isSettled());
    }

    public function testPlaceOrderWithLimitOrder()
    {
        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 8000, 0.001);
        $order = $this->orders->placeOrder($limitOrderToPlace);

        self::assertIsString($order->getId());
        self::assertIsFloat($order->getPrice());
        self::assertIsFloat($order->getSize());
        self::assertIsString($order->getProductId());
        self::assertIsString($order->getSide());
        self::assertIsString($order->getSelfTradePrevention());
        self::assertIsString($order->getType());
        self::assertIsString($order->getTimeInForce());
        self::assertIsBool($order->isPostOnly());
        self::assertInstanceOf(\DateTimeInterface::class, $order->getCreatedAt());
        self::assertIsFloat($order->getFillFees());
        self::assertIsFloat($order->getFilledSize());
        self::assertIsFloat($order->getExecutedValue());
        self::assertIsString($order->getStatus());
        self::assertIsBool($order->isSettled());
    }
}
