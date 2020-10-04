<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Rate;

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Functional\Api\CoinbaseApi;
use MockingMagician\CoinbaseProSdk\Functional\Api\Config;
use MockingMagician\CoinbaseProSdk\Functional\Api\ApiFactory;
use MockingMagician\CoinbaseProSdk\Functional\Api\Config\CoinbaseConfig;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Orders;
use MockingMagician\CoinbaseProSdk\Functional\Error\RateLimitsErrorToManaged;
use MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity\AbstractTest;

/**
 * @internal
 */
class RateLimitsTest extends AbstractTest
{
    /**
     * @var ApiInterface
     */
    private $apiWithRateLimitsGuard;
    /**
     * @var ApiInterface
     */
    private $apiWithOutRateLimitsGuard;

    public function setUp(): void
    {
        parent::setUp();

        $apiConfig = CoinbaseConfig::createDefault(
            $this->apiParams->getEndPoint(),
            $this->apiParams->getKey(),
            $this->apiParams->getSecret(),
            $this->apiParams->getPassphrase()
        );

        $this->apiWithRateLimitsGuard = new CoinbaseApi($apiConfig);

        $apiConfig->setManageRateLimits(false);

        $this->apiWithOutRateLimitsGuard = new CoinbaseApi($apiConfig);
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
        $i = 50;
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
                    file_put_contents($file_expect_rate_limit, RateLimitsErrorToManaged::class);
                } finally {
                    exit();
                }
            }
        }

        while (-1 != pcntl_waitpid(0, $status));

        $rateLimitAsExceeded = false;

        try {
            $rateLimitAsExceeded = RateLimitsErrorToManaged::class === file_get_contents($file_expect_rate_limit);
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
        $i = 50;
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
                    file_put_contents($file_expect_rate_limit, RateLimitsErrorToManaged::class);
                } finally {
                    exit();
                }
            }
        }

        while (-1 != pcntl_waitpid(0, $status));

        $rateLimitAsExceeded = false;

        try {
            $rateLimitAsExceeded = RateLimitsErrorToManaged::class === file_get_contents($file_expect_rate_limit);
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
