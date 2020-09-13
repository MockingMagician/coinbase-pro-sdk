<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Oracle;

/**
 * @internal
 */
class OracleTest extends AbstractTest
{
    /**
     * @var Oracle
     */
    private $oracle;

    public function setUp(): void
    {
        parent::setUp();
        $this->oracle = new Oracle($this->requestManager);
    }

    public function testCryptographicallySignedPricesRaw()
    {
        $raw = $this->oracle->getCryptographicallySignedPricesRaw();

        self::assertStringContainsString('"timestamp":', $raw);
        self::assertStringContainsString('"messages":', $raw);
        self::assertStringContainsString('"signatures":', $raw);
        self::assertStringContainsString('"prices":', $raw);
    }

    public function testCryptographicallySignedPrices()
    {
        $cryptoSignedPrices = $this->oracle->getCryptographicallySignedPrices();

        self::assertIsInt($cryptoSignedPrices->getTimestamp());
        self::assertIsArray($cryptoSignedPrices->getMessages());
        self::assertIsArray($cryptoSignedPrices->getSignatures());
        self::assertIsArray($cryptoSignedPrices->getPrices());
    }
}
