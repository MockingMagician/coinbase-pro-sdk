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
        $this->markTestSkipped('Not able to be tested as is because the test API (public) seems to be unrestrained. :/');
    }

    public function testToFailPrivateIfNotManageRateLimits()
    {
        $file_expect_rate_limit = __DIR__.'/expect_rate_limit.txt';

        try {
            unlink($file_expect_rate_limit);
        } catch (\Throwable $exception) {
        }
        $i = 100;
        while ($i--) {
            $pid = pcntl_fork();

            if (-1 == $pid) {
                $this->markTestIncomplete('Fork as failed for concurrent api call');

                return;
            }
            if (0 == $pid) {
                try {
                    $this->apiWithOutRateLimitsGuard->orders()->listOrders(Orders::STATUS, 'BTC-USD');
                } catch (\Throwable $exception) {
                    file_put_contents($file_expect_rate_limit, $exception->getMessage()."\n");
                } finally {
                    exit();
                }
            }
        }

        while (-1 != pcntl_waitpid(0, $status));

        $rateLimitAsExceeded = false;

        try {
            $rateLimitAsExceeded = "Private rate limit exceeded\n" === file_get_contents($file_expect_rate_limit);
            unlink($file_expect_rate_limit);
        } catch (\Throwable $exception) {
        }

        self::assertTrue($rateLimitAsExceeded);
    }

    public function testNotFailPrivateIfManageRateLimits()
    {
        $file_expect_rate_limit = __DIR__.'/expect_rate_limit.txt';

        try {
            unlink($file_expect_rate_limit);
        } catch (\Throwable $exception) {
        }
        $i = 100;
        while ($i--) {
            $pid = pcntl_fork();

            if (-1 == $pid) {
                $this->markTestIncomplete('Fork as failed for concurrent api call');

                return;
            }
            if (0 == $pid) {
                try {
                    $this->apiWithRateLimitsGuard->orders()->listOrders(Orders::STATUS, 'BTC-USD');
                } catch (\Throwable $exception) {
                    file_put_contents($file_expect_rate_limit, $exception->getMessage()."\n");
                } finally {
                    exit();
                }
            }
        }

        while (-1 != pcntl_waitpid(0, $status));

        $rateLimitAsExceeded = false;

        try {
            $rateLimitAsExceeded = "Private rate limit exceeded\n" === file_get_contents($file_expect_rate_limit);
            unlink($file_expect_rate_limit);
        } catch (\Throwable $exception) {
        }

        self::assertFalse($rateLimitAsExceeded);
    }

    public function testCallPrivateRespectRateLimit()
    {
        $this->markTestSkipped('Not really useful test cause request can take more time than rates. Only async should be come afterwards');

        $starTime = microtime(true);
        for ($i = 0; $i < 25; ++$i) {
            $this->apiWithOutRateLimitsGuard->fees()->getCurrentFees();
        }
        $endTime = microtime(true);
        $timeWithoutGuard = $endTime - $starTime;

        $starTime = microtime(true);
        for ($i = 0; $i < 25; ++$i) {
            $this->apiWithRateLimitsGuard->fees()->getCurrentFees();
        }
        $endTime = microtime(true);
        $timeWithGuard = $endTime - $starTime;

        self::assertGreaterThanOrEqual($timeWithoutGuard, $timeWithGuard);
    }
}
