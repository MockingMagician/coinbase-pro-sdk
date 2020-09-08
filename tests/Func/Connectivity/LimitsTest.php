<?php


namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Fees;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Fills;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Limits;

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
