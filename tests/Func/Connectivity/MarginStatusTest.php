<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Margin;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Products;

class MarginStatusTest extends AbstractTest
{
    /**
     * @var Margin
     */
    protected $margin;

    public function setUp(): void
    {
        parent::setUp();
        $this->margin = new Margin($this->requestManager);
    }

    public function testGetMarginStatusRaw()
    {
        $raw = $this->margin->getMarginStatusRaw();

        self::assertStringContainsString('"tier":', $raw);
        self::assertStringContainsString('"enabled":', $raw);
        self::assertStringContainsString('"eligible":', $raw);
    }

    public function testGetMargin()
    {
        $status = $this->margin->getMarginStatus();

        self::assertIsInt($status->getTier());
        self::assertIsBool($status->isEligible());
        self::assertIsBool($status->isEnabled());
    }
}
