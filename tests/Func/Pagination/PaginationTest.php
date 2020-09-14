<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Pagination;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountHistoryEventDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\Pagination;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Deposits;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Fills;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Withdrawals;
use MockingMagician\CoinbaseProSdk\Functional\DTO\DepositData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\FillData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\WithdrawalsData;
use MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity\AbstractTest;

class PaginationTest extends AbstractTest
{
    /**
     * @var Accounts
     */
    private $accounts;
    /**
     * @var Fills
     */
    private $fills;
    /**
     * @var Deposits
     */
    private $deposits;
    /**
     * @var Withdrawals
     */
    private $withdrawals;

    public function setUp(): void
    {
        parent::setUp();
        $this->accounts = new Accounts($this->requestManager);
        $this->fills = new Fills($this->requestManager);
        $this->deposits = new Deposits($this->requestManager);
        $this->withdrawals = new Withdrawals($this->requestManager);
    }

    /**
     * @
     */
    public function testPaginationOfGetAccountHistory()
    {
        $accountId = null;
        $accounts = $this->accounts->list();
        foreach ($accounts as $account) {
            if ($account->getCurrency() === 'BTC') {
                $accountId = $account->getId();
            }
        }

        // Descending side
        $pagination = new Pagination(Pagination::DIRECTION_DESC, null, 50);

        $previousIds = [];

        while ($pagination->hasNext()) {
            $currentIds = $this->accounts->getAccountHistory($accountId, $pagination);
            $currentIds = array_map(function (AccountHistoryEventDataInterface $history) {return $history->getId();}, $currentIds);

            foreach ($currentIds as $id) {
                self::assertNotContains($id, $previousIds);
            }

            $previousIds = array_merge($previousIds, $currentIds);
        }

        // Ascending side
        $pagination = new Pagination(Pagination::DIRECTION_ASC, end($previousIds), 50);

        $previousIds = [];

        while ($pagination->hasNext()) {
            $currentIds = $this->accounts->getAccountHistory($accountId, $pagination);
            $currentIds = array_map(function (AccountHistoryEventDataInterface $history) {return $history->getId();}, $currentIds);

            foreach ($currentIds as $id) {
                self::assertNotContains($id, $previousIds);
            }

            $previousIds = array_merge($previousIds, $currentIds);
        }
    }

    public function testPaginationOfFills()
    {
        // Descending side
        $pagination = new Pagination(Pagination::DIRECTION_DESC, null, 50);

        $previousIds = [];

        while ($pagination->hasNext()) {
            $currentIds = $this->fills->listFills(null, 'BTC-USD', $pagination);
            $currentIds = array_map(function (FillData $fill) {return $fill->getTradeId();}, $currentIds);

            foreach ($currentIds as $id) {
                self::assertNotContains($id, $previousIds);
            }

            $previousIds = array_merge($previousIds, $currentIds);
        }

        // Ascending side
        $pagination = new Pagination(Pagination::DIRECTION_ASC, end($previousIds), 50);

        $previousIds = [];

        while ($pagination->hasNext()) {
            $currentIds = $this->fills->listFills(null, 'BTC-USD', $pagination);
            $currentIds = array_map(function (FillData $fill) {return $fill->getTradeId();}, $currentIds);

            foreach ($currentIds as $id) {
                self::assertNotContains($id, $previousIds);
            }

            $previousIds = array_merge($previousIds, $currentIds);
        }
    }

    public function testPaginationOfDeposits()
    {
        // Descending side
        $pagination = new Pagination(Pagination::DIRECTION_DESC, null, 50);

        $previousIds = [];

        while ($pagination->hasNext()) {
            $currentIds = $this->deposits->listDeposits(null, $pagination);
            $currentIds = array_map(function (DepositData $data) {return $data->getId();}, $currentIds);

            foreach ($currentIds as $id) {
                self::assertNotContains($id, $previousIds);
            }

            $previousIds = array_merge($previousIds, $currentIds);
        }

        // Ascending side
        $pagination = new Pagination(Pagination::DIRECTION_ASC, $pagination->getOffset(), 50);

        $previousIds = [];

        while ($pagination->hasNext()) {
            $currentIds = $this->deposits->listDeposits(null, $pagination);
            $currentIds = array_map(function (DepositData $data) {return $data->getId();}, $currentIds);

            foreach ($currentIds as $id) {
                self::assertNotContains($id, $previousIds);
            }

            $previousIds = array_merge($previousIds, $currentIds);
        }
    }

    public function testPaginationOfWithdrawals()
    {
        // Descending side
        $pagination = new Pagination(Pagination::DIRECTION_DESC, null, 25);

        $previousIds = [];

        while ($pagination->hasNext()) {
            $currentIds = $this->withdrawals->listWithdrawals(null, $pagination);
            $currentIds = array_map(function (WithdrawalsData $data) {return $data->getId();}, $currentIds);

            foreach ($currentIds as $id) {
                self::assertNotContains($id, $previousIds);
            }

            $previousIds = array_merge($previousIds, $currentIds);
        }

        // Ascending side
        $pagination = new Pagination(Pagination::DIRECTION_ASC, $pagination->getOffset(), 25);

        $previousIds = [];

        while ($pagination->hasNext()) {
            $currentIds = $this->withdrawals->listWithdrawals(null, $pagination);
            $currentIds = array_map(function (WithdrawalsData $data) {return $data->getId();}, $currentIds);

            foreach ($currentIds as $id) {
                self::assertNotContains($id, $previousIds);
            }

            $previousIds = array_merge($previousIds, $currentIds);
        }
    }
}
