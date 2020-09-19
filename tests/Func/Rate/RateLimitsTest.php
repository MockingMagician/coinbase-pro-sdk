<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Rate;

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;
use MockingMagician\CoinbaseProSdk\Functional\ApiFactory;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Orders;
use MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity\AbstractTest;

/**
 * @internal
 */
class RateLimitsTest extends AbstractTest
{
    /**
     * @var ApiConnectivityInterface
     */
    private $apiWithRateLimitsGuard;
    /**
     * @var ApiConnectivityInterface
     */
    private $apiWithOutRateLimitsGuard;

    public function setUp(): void
    {
        parent::setUp();
        $this->apiWithOutRateLimitsGuard = ApiFactory::createFull(
            $this->apiParams->getEndPoint(),
            $this->apiParams->getKey(),
            $this->apiParams->getSecret(),
            $this->apiParams->getPassphrase(),
            false,
            false
        );
        $this->apiWithRateLimitsGuard = ApiFactory::createFull(
            $this->apiParams->getEndPoint(),
            $this->apiParams->getKey(),
            $this->apiParams->getSecret(),
            $this->apiParams->getPassphrase(),
            false,
            true
        );
    }

    public function testToFailPublic()
    {
        $this->markTestIncomplete('Not to be tested as is because the test API seems to be unrestrained.');
    }

    public function testToFailPrivate()
    {
        $this->markTestIncomplete('Not to be tested as is because the test API seems to be unrestrained.');
    }

    public function testNotFailToPublic()
    {
        for ($i = 0; $i < 50; $i++) {
            $this->apiWithRateLimitsGuard->orders()->listOrders(Orders::STATUS, 'BTC-USD');
        }
    }
}
