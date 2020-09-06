<?php


namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
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

    public function testGetAccountRaw()
    {
        $list = $this->accounts->list();
        $raw = $this->accounts->getAccountRaw($list[0]->getId());

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"currency":', $raw);
        self::assertStringContainsString('"balance":', $raw);
        self::assertStringContainsString('"hold":', $raw);
        self::assertStringContainsString('"available":', $raw);
        self::assertStringContainsString('"profile_id":', $raw);
        self::assertStringContainsString('"trading_enabled":', $raw);
    }

    public function testGetAccount()
    {
        $list = $this->accounts->list();
        $account = $this->accounts->getAccount($list[0]->getId());

        self::assertInstanceOf(AccountDataInterface::class, $list[0]);
        self::assertIsString($account->getId());
        self::assertIsString($account->getProfileId());
        self::assertIsString($account->getCurrency());
        self::assertIsFloat($account->getBalance());
        self::assertIsFloat($account->getHoldFunds());
        self::assertIsFloat($account->getAvailableFunds());
        self::assertIsBool($account->isTradingEnabled());
    }

    /**
     * TODO data is missing for tests
     */
    public function testGetAccountHistoryRaw()
    {
        $list = $this->accounts->list();
        $raw = $this->accounts->getAccountHistoryRaw($list[0]->getId());
    }

    /**
     * TODO data is missing for tests
     */
    public function testGetAccountHistory()
    {
    }

    /**
     * TODO data is missing for tests
     */
    public function testGetHoldsRaw()
    {
        $list = $this->accounts->list();
        $raw = $this->accounts->getHoldsRaw($list[0]->getId());
    }

    /**
     * TODO data is missing for tests
     */
    public function testGetHolds()
    {
    }
}
