<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;

/**
 * @internal
 */
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

    public function testGetAccountHistoryRaw()
    {
        $list = $this->accounts->list();

        foreach ($list as $account) {
            $raw = $this->accounts->getAccountHistoryRaw($account->getId());
            if ('[]' !== $raw) {
                self::assertStringContainsString('"id":', $raw);
                self::assertStringContainsString('"created_at":', $raw);
                self::assertStringContainsString('"amount":', $raw);
                self::assertStringContainsString('"balance":', $raw);
                self::assertStringContainsString('"type":', $raw);
                self::assertStringContainsString('"details":', $raw);
            }
        }
    }

    public function testGetAccountHistory()
    {
        $list = $this->accounts->list();

        foreach ($list as $account) {
            $accountHistory = $this->accounts->getAccountHistory($account->getId());
            if (!empty($accountHistory)) {
                $accountHistoryEvent = $accountHistory[0];
                self::assertIsString($accountHistoryEvent->getId());
                self::assertInstanceOf(\DateTimeInterface::class, $accountHistoryEvent->getCreatedAt());
                self::assertIsFloat($accountHistoryEvent->getBalance());
                self::assertIsFloat($accountHistoryEvent->getAmount());
                self::assertIsString($accountHistoryEvent->getType());
                self::assertIsArray($accountHistoryEvent->getDetails());
            }
        }
    }

    public function testGetHoldsRaw()
    {
        // todo create some hold data by passing order impossible to realize
        $this->markTestSkipped(
            'Data is missing for tests'
        );
        $list = $this->accounts->list();
        foreach ($list as $accountData) {
            $raw = $this->accounts->getHoldsRaw($list[0]->getId());
        }
    }

    public function testGetHolds()
    {
        $this->markTestSkipped(
            'Data is missing for tests'
        );
    }
}
