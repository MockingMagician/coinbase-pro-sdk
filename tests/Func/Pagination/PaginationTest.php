<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Pagination;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountHistoryEventDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\Pagination;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Deposits;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Fills;
use MockingMagician\CoinbaseProSdk\Functional\DTO\FillData;
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

    public function setUp(): void
    {
        parent::setUp();
        $this->accounts = new Accounts($this->requestManager);
        $this->fills = new Fills($this->requestManager);
        $this->deposits = new Deposits($this->requestManager);
    }

    /**
     * @
     */
    public function testPaginationOfGetAccountHistory()
    {
        $this->markTestSkipped();

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
        $this->markTestSkipped();

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
//        $this->markTestSkipped();

        // Descending side
        $pagination = new Pagination(Pagination::DIRECTION_DESC, null, 50);

        $previousIds = [];

        while ($pagination->hasNext()) {
            $currentIds = $this->deposits->listDeposits(null, null, $pagination);
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
}
