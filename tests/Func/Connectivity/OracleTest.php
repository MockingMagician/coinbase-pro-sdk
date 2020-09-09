<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\TimeDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Oracle;

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
