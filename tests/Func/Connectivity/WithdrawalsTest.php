<?php


namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;


use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Withdrawals;

class WithdrawalsTest extends AbstractTest
{
    /**
     * @var Withdrawals
     */
    private $withdrawals;

    public function setUp(): void
    {
        parent::setUp();
        $this->withdrawals = new Withdrawals($this->requestManager);
    }
}
