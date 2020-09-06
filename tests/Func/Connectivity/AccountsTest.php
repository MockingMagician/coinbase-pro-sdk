<?php


namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TimeDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;

class AccountsTest extends AbstractTest
{
    /**
     * @var Accounts
     */
    private $accounts;

    public function setUp(): void
    {
        parent::setUp();
        $this->accounts = new Accounts($this->requestManager);
    }

    public function testListRaw()
    {
        $raw = $this->accounts->listRaw();

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"currency":', $raw);
        self::assertStringContainsString('"balance":', $raw);
        self::assertStringContainsString('"hold":', $raw);
        self::assertStringContainsString('"available":', $raw);
        self::assertStringContainsString('"profile_id":', $raw);
        self::assertStringContainsString('"trading_enabled":', $raw);
    }

    public function testList()
    {
        $list = $this->accounts->list();

        self::assertInstanceOf(AccountDataInterface::class, $list[0]);
        self::assertIsString($list[0]->getId());
        self::assertIsString($list[0]->getProfileId());
        self::assertIsString($list[0]->getCurrency());
        self::assertIsFloat($list[0]->getBalance());
        self::assertIsFloat($list[0]->getHoldFunds());
        self::assertIsFloat($list[0]->getAvailableFunds());
        self::assertIsBool($list[0]->isTradingEnabled());
    }
}
