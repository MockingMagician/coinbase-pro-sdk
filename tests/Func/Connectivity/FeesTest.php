<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Fees;

/**
 * @internal
 * @coversNothing
 */
class FeesTest extends AbstractTest
{
    /**
     * @var Fees
     */
    private $fees;

    public function setUp(): void
    {
        parent::setUp();
        $this->fees = new Fees($this->requestManager);
    }

    public function testListRaw()
    {
        $raw = $this->fees->getCurrentFeesRaw();

        self::assertStringContainsString('"maker_fee_rate":', $raw);
        self::assertStringContainsString('"taker_fee_rate":', $raw);
        self::assertStringContainsString('"usd_volume":', $raw);
    }

    public function testList()
    {
        $fees = $this->fees->getCurrentFees();

        self::assertIsFloat($fees->getMakerFeeRate());
        self::assertIsFloat($fees->getTakerFeeRate());
        self::assertIsFloat($fees->getUsdVolume());
    }
}
