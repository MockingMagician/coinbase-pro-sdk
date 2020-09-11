<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Fills;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Orders;

/**
 * @internal
 * @coversNothing
 */
class FillsTest extends AbstractTest
{
    /**
     * @var Fills
     */
    private $fills;
    /**
     * @var Orders
     */
    private $orders;

    public function setUp(): void
    {
        parent::setUp();
        $this->fills = new Fills($this->requestManager);
        $this->orders = new Orders($this->requestManager);
    }

    public function testListFillsRaw()
    {
        $raw = $this->fills->listFillsRaw(null, 'BTC-USD');

        self::assertStringContainsString('"trade_id":', $raw);
        self::assertStringContainsString('"product_id":', $raw);
        self::assertStringContainsString('"price":', $raw);
        self::assertStringContainsString('"size":', $raw);
        self::assertStringContainsString('"order_id":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"liquidity":', $raw);
        self::assertStringContainsString('"fee":', $raw);
        self::assertStringContainsString('"settled":', $raw);
        self::assertStringContainsString('"side":', $raw);

        preg_match('#"order_id":"([a-z0-9-]+)"#', $raw, $matches);
        $orderId = $matches[1];

        $raw = $this->fills->listFillsRaw($orderId);

        self::assertStringContainsString('"trade_id":', $raw);
        self::assertStringContainsString('"product_id":', $raw);
        self::assertStringContainsString('"price":', $raw);
        self::assertStringContainsString('"size":', $raw);
        self::assertStringContainsString('"order_id":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"liquidity":', $raw);
        self::assertStringContainsString('"fee":', $raw);
        self::assertStringContainsString('"settled":', $raw);
        self::assertStringContainsString('"side":', $raw);

        $raw = $this->fills->listFillsRaw($orderId, 'BTC-USD');

        self::assertStringContainsString('"trade_id":', $raw);
        self::assertStringContainsString('"product_id":', $raw);
        self::assertStringContainsString('"price":', $raw);
        self::assertStringContainsString('"size":', $raw);
        self::assertStringContainsString('"order_id":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"liquidity":', $raw);
        self::assertStringContainsString('"fee":', $raw);
        self::assertStringContainsString('"settled":', $raw);
        self::assertStringContainsString('"side":', $raw);
    }

    public function testList()
    {
        $fills = $this->fills->listFills(null, 'BTC-USD');

        foreach ($fills as $fill) {
            self::assertIsString($fill->getProductId());
            self::assertIsString($fill->getOrderId());
            self::assertIsString($fill->getSide());
            self::assertIsString($fill->getLiquidity());
            self::assertInstanceOf(\DateTimeInterface::class, $fill->getCreatedAt());
            self::assertIsInt($fill->getTradeId());
            self::assertIsFloat($fill->getSize());
            self::assertIsFloat($fill->getPrice());
            self::assertIsFloat($fill->getFee());
            self::assertIsBool($fill->isSettled());
        }
    }
}
