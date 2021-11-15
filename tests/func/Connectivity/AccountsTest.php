<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use DateTimeImmutable;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;

/**
 * @internal
 */
class AccountsTest extends AbstractTest
{
    use TraitAssertMore;
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
            $raw = $this->accounts->getAccountLedgerRaw($account->getId());
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
            $accountHistory = $this->accounts->getAccountLedger($account->getId());
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
        $list = $this->accounts->list();
        foreach ($list as $accountData) {
            $raw = $this->accounts->getHoldsRaw($accountData->getId());
            if ('[]' === $raw) {
                continue;
            }
            self::assertStringContainsString('"id":', $raw);
            self::assertStringContainsString('"created_at":', $raw);
            self::assertStringContainsString('"amount":', $raw);
            self::assertStringContainsString('"ref":', $raw);
        }
    }

    public function testGetHolds()
    {
        $list = $this->accounts->list();
        foreach ($list as $accountData) {
            $holds = $this->accounts->getHolds($accountData->getId());
            if (empty($holds)) {
                continue;
            }
            foreach ($holds as $hold) {
                self::assertIsString($hold->getId());
                self::assertIsFloat($hold->getAmount());
                self::assertIsString($hold->getType());
                self::assertIsString($hold->getRef());
                self::assertInstanceOf(DateTimeImmutable::class, $hold->getCreatedAt());
                self::assertNullOrInstanceOf(DateTimeImmutable::class, $hold->getUpdatedAt());
            }
        }
    }

    public function testGetTransfersRaw()
    {
        $list = $this->accounts->list();
        foreach ($list as $accountData) {
            $raw = $this->accounts->getTransfersRaw($accountData->getId());
            if ('[]' === $raw) {
                continue;
            }
            self::assertStringContainsString('"id":', $raw);
            self::assertStringContainsString('"type":', $raw);
            self::assertStringContainsString('"created_at":', $raw);
            self::assertStringContainsString('"completed_at":', $raw);
            self::assertStringContainsString('"canceled_at":', $raw);
            self::assertStringContainsString('"processed_at":', $raw);
            self::assertStringContainsString('"user_nonce":', $raw);
            self::assertStringContainsString('"amount":', $raw);
            self::assertStringContainsString('"details":', $raw);
            self::assertStringContainsString('"idem":', $raw);
        }
    }

    public function testGetTransfers()
    {
        $list = $this->accounts->list();
        foreach ($list as $accountData) {
            $transfers = $this->accounts->getTransfers($accountData->getId());
            if (empty($transfers)) {
                continue;
            }
            foreach ($transfers as $transfer) {
                self::assertIsString($transfer->getId());
                self::assertIsFloat($transfer->getAmount());
                self::assertIsString($transfer->getType());
                self::assertNullOrInstanceOf(DateTimeImmutable::class, $transfer->getCreatedAt());
                self::assertNullOrInstanceOf(DateTimeImmutable::class, $transfer->getProcessedAt());
                self::assertNullOrInstanceOf(DateTimeImmutable::class, $transfer->getCompletedAt());
                self::assertNullOrInstanceOf(DateTimeImmutable::class, $transfer->getCanceledAt());
                self::assertIsNullOrIsInt($transfer->getUserNonce());
                self::assertIsNullOrIsString($transfer->getIdem());
                self::assertIsArray($transfer->getDetails());
            }
        }
    }
}
