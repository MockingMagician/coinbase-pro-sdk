<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Limits;

/**
 * @internal
 * @coversNothing
 */
class LimitsTest extends AbstractTest
{
    /**
     * @var Limits
     */
    private $limits;

    public function setUp(): void
    {
        parent::setUp();
        $this->limits = new Limits($this->requestManager);
    }

    public function testCurrentExchangeLimitsRaw()
    {
        $raw = $this->limits->getCurrentExchangeLimitsRaw();

        self::assertStringContainsString('"limit_currency":', $raw);
        self::assertStringContainsString('"transfer_limits":', $raw);
    }

    public function testCurrentExchangeLimits()
    {
        $limits = $this->limits->getCurrentExchangeLimits();

        self::assertIsString($limits->getLimitCurrency());
        self::assertIsArray($limits->getTransferLimits());
    }
}
