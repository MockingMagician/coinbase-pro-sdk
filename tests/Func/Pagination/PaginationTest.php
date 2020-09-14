<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Pagination;


use MockingMagician\CoinbaseProSdk\Functional\Build\Pagination;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;
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

    public function setUp(): void
    {
        parent::setUp();
        $this->accounts = new Accounts($this->requestManager);
        $this->fills = new Fills($this->requestManager);
    }

    public function testPaginationOfGetAccountHistory()
    {
//        $accountId = null;
//        $accounts = $this->accounts->list();
//        foreach ($accounts as $account) {
//            if ($account->getCurrency() === 'BTC') {
//                $accountId = $account->getId();
//            }
//        }
//
//        $pagination = new Pagination(Pagination::AFTER, null, 50);
//
//        while ($pagination->hasNext()) {
//            $history = $this->accounts->getAccountHistory($accountId, $pagination);
//
//            $history = array_map(function ($history) {return $history->getId();}, $history);
//
//            dump([
//                'history' => $history,
//                'pagination' => $pagination,
//            ]);
//        }
    }

    public function testPaginationOfFills()
    {
        $accountId = null;
        $accounts = $this->accounts->list();
        foreach ($accounts as $account) {
            if ($account->getCurrency() === 'BTC') {
                $accountId = $account->getId();
            }
        }

        $pagination = new Pagination(null, null, 10);

        while ($pagination->hasNext()) {
            $fills = $this->fills->listFills(null, 'BTC-USD', $pagination);

            $fills = array_map(function (FillData $fill) {return $fill->getTradeId();}, $fills);

            dump([
                '$fills' => $fills,
                'pagination' => $pagination,
            ]);
        }
    }
}
