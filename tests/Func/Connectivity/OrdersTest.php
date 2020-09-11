<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Build\LimitOrderToPlace;
use MockingMagician\CoinbaseProSdk\Functional\Build\MarketOrderToPlace;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Orders;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Products;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

/**
 * @internal
 * @coversNothing
 */
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

    public static function randomUUID()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
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

    public function testDeleteOrderRaw()
    {
        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001);
        $order = $this->orders->placeOrder($limitOrderToPlace);
        $raw = $this->orders->cancelOrderByIdRaw($order->getId());

        self::assertIsString($raw);
        self::assertEquals($order->getId(), json_decode($raw, true));

        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001);
        $order = $this->orders->placeOrder($limitOrderToPlace);
        $raw = $this->orders->cancelOrderByIdRaw($order->getId(), $order->getProductId());

        self::assertIsString($raw);
        self::assertEquals($order->getId(), json_decode($raw, true));
    }

    public function testDeleteOrderRawFail()
    {
        self::expectException(ApiError::class);
        self::expectExceptionMessage('Invalid order id');
        $this->orders->cancelOrderByIdRaw('not_a_valid_id');
    }

    public function testDeleteOrder()
    {
        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001);
        $order = $this->orders->placeOrder($limitOrderToPlace);
        $isCancelled = $this->orders->cancelOrderById($order->getId());

        self::assertTrue($isCancelled);

        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001);
        $order = $this->orders->placeOrder($limitOrderToPlace);
        $isCancelled = $this->orders->cancelOrderById($order->getId(), $order->getProductId());

        self::assertTrue($isCancelled);
    }

    public function testDeleteOrderByClientIdRaw()
    {
        $clientOrderId = self::randomUUID();
        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001, null, null, false, null, null, null, $clientOrderId);
        $order = $this->orders->placeOrder($limitOrderToPlace);

        $raw = $this->orders->cancelOrderByClientOrderIdRaw($clientOrderId);

        self::assertIsString($raw);
        self::assertEquals($order->getId(), json_decode($raw, true));

        $clientOrderId = self::randomUUID();
        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001, null, null, false, null, null, null, $clientOrderId);
        $order = $this->orders->placeOrder($limitOrderToPlace);

        $raw = $this->orders->cancelOrderByClientOrderIdRaw($clientOrderId, $order->getProductId());

        self::assertIsString($raw);
        self::assertEquals($order->getId(), json_decode($raw, true));
    }

    public function testDeleteOrderByClientId()
    {
        $clientOrderId = self::randomUUID();
        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001, null, null, false, null, null, null, $clientOrderId);
        $this->orders->placeOrder($limitOrderToPlace);

        $isCancelled = $this->orders->cancelOrderByClientOrderId($clientOrderId);
        self::assertTrue($isCancelled);

        $clientOrderId = self::randomUUID();
        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001, null, null, false, null, null, null, $clientOrderId);
        $order = $this->orders->placeOrder($limitOrderToPlace);

        $isCancelled = $this->orders->cancelOrderByClientOrderId($clientOrderId, $order->getProductId());
        self::assertTrue($isCancelled);
    }

    public function testDeleteAllOrdersRaw()
    {
        $this->orders->cancelAllOrdersRaw();
        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001);
        $orders = [];
        for ($i = 0; $i < 3; ++$i) {
            $orders[] = $this->orders->placeOrder($limitOrderToPlace)->getId();
        }

        $cancelled = json_decode($this->orders->cancelAllOrdersRaw(), true);

        foreach ($cancelled as $value) {
            self::assertContains($value, $orders);
        }
    }

    public function testDeleteAllOrder()
    {
        $this->orders->cancelAllOrders();
        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001);
        $orders = [];
        for ($i = 0; $i < 3; ++$i) {
            $orders[] = $this->orders->placeOrder($limitOrderToPlace)->getId();
        }

        $cancelled = $this->orders->cancelAllOrders();

        foreach ($cancelled as $value) {
            self::assertContains($value, $orders);
        }
    }

    public function testListOrdersRaw()
    {
        $orderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001);
        $this->orders->placeOrder($orderToPlace);
        $orderToPlace = new MarketOrderToPlace(MarketOrderToPlace::SIDE_BUY, 'BTC-USD', 0.001, null);
        $this->orders->placeOrder($orderToPlace);
        $raw = $this->orders->listOrdersRaw();

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"product_id":', $raw);
        self::assertStringContainsString('"side":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"post_only":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"fill_fees":', $raw);
        self::assertStringContainsString('"filled_size":', $raw);
        self::assertStringContainsString('"executed_value":', $raw);
        self::assertStringContainsString('"status":', $raw);
        self::assertStringContainsString('"settled":', $raw);
    }

    public function testListOrders()
    {
        $orderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001);
        $this->orders->placeOrder($orderToPlace);
        $orderToPlace = new MarketOrderToPlace(MarketOrderToPlace::SIDE_BUY, 'BTC-USD', 0.001, null);
        $this->orders->placeOrder($orderToPlace);
        $orders = $this->orders->listOrders();

        foreach ($orders as $order) {
            self::assertIsString($order->getId());
            self::assertIsFloat($order->getSize());
            self::assertIsString($order->getProductId());
            self::assertIsString($order->getSide());
            self::assertIsString($order->getType());
            self::assertIsBool($order->isPostOnly());
            self::assertInstanceOf(\DateTimeInterface::class, $order->getCreatedAt());
            self::assertIsFloat($order->getFillFees());
            self::assertIsFloat($order->getFilledSize());
            self::assertIsFloat($order->getExecutedValue());
            self::assertIsString($order->getStatus());
            self::assertIsBool($order->isSettled());
        }
    }

    public function testGetAnOrderRaw()
    {
        $orderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001);
        $order = $this->orders->placeOrder($orderToPlace);
        $raw = $this->orders->getOrderByIdRaw($order->getId());

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"product_id":', $raw);
        self::assertStringContainsString('"side":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"post_only":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"fill_fees":', $raw);
        self::assertStringContainsString('"filled_size":', $raw);
        self::assertStringContainsString('"executed_value":', $raw);
        self::assertStringContainsString('"status":', $raw);
        self::assertStringContainsString('"settled":', $raw);
    }

    public function testGetAnOrder()
    {
        $orderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001);
        $orderPlaced = $this->orders->placeOrder($orderToPlace);
        $order = $this->orders->getOrderById($orderPlaced->getId());

        self::assertIsString($order->getId());
        self::assertIsFloat($order->getSize());
        self::assertIsString($order->getProductId());
        self::assertIsString($order->getSide());
        self::assertIsString($order->getType());
        self::assertIsBool($order->isPostOnly());
        self::assertInstanceOf(\DateTimeInterface::class, $order->getCreatedAt());
        self::assertIsFloat($order->getFillFees());
        self::assertIsFloat($order->getFilledSize());
        self::assertIsFloat($order->getExecutedValue());
        self::assertIsString($order->getStatus());
        self::assertIsBool($order->isSettled());
    }

    public function testGetOrderByClientOrderIdRaw()
    {
        $clientOrderId = self::randomUUID();
        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001, null, null, false, null, null, null, $clientOrderId);
        $this->orders->placeOrder($limitOrderToPlace);

        $raw = $this->orders->getOrderByClientOrderIdRaw($clientOrderId);

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"product_id":', $raw);
        self::assertStringContainsString('"side":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"post_only":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"fill_fees":', $raw);
        self::assertStringContainsString('"filled_size":', $raw);
        self::assertStringContainsString('"executed_value":', $raw);
        self::assertStringContainsString('"status":', $raw);
        self::assertStringContainsString('"settled":', $raw);
    }

    public function testGetOrderByClientOrderId()
    {
        $clientOrderId = self::randomUUID();
        $limitOrderToPlace = new LimitOrderToPlace(LimitOrderToPlace::SIDE_BUY, 'BTC-USD', 0.01, 0.001, null, null, false, null, null, null, $clientOrderId);
        $this->orders->placeOrder($limitOrderToPlace);

        $order = $this->orders->getOrderByClientOrderId($clientOrderId);

        self::assertIsString($order->getId());
        self::assertIsFloat($order->getSize());
        self::assertIsString($order->getProductId());
        self::assertIsString($order->getSide());
        self::assertIsString($order->getType());
        self::assertIsBool($order->isPostOnly());
        self::assertInstanceOf(\DateTimeInterface::class, $order->getCreatedAt());
        self::assertIsFloat($order->getFillFees());
        self::assertIsFloat($order->getFilledSize());
        self::assertIsFloat($order->getExecutedValue());
        self::assertIsString($order->getStatus());
        self::assertIsBool($order->isSettled());
    }
}
