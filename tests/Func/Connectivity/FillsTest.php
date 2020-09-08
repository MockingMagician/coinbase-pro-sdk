<?php


namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Fees;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Fills;

class FillsTest extends AbstractTest
{
    /**
     * @var Fills
     */
    private $fills;

    public function setUp(): void
    {
        parent::setUp();
        $this->fills = new Fills($this->requestManager);
    }

    public function testListFillsRaw()
    {
        $raw = $this->fills->listFillsRaw();

        var_dump($raw);

//        self::assertStringContainsString('"maker_fee_rate":', $raw);
//        self::assertStringContainsString('"taker_fee_rate":', $raw);
//        self::assertStringContainsString('"usd_volume":', $raw);
    }

//    public function testList()
//    {
//        $fees = $this->fees->getCurrentFees();
//
//        self::assertIsFloat($fees->getMakerFeeRate());
//        self::assertIsFloat($fees->getTakerFeeRate());
//        self::assertIsFloat($fees->getUsdVolume());
//    }
}
