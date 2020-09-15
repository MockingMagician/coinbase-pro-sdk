<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use Dotenv\Dotenv;
use Exception;
use GuzzleHttp\Client;
use MockingMagician\CoinbaseProSdk\Functional\ApiParams;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Time;
use MockingMagician\CoinbaseProSdk\Functional\RequestManager;
use PHPUnit\Framework\TestCase;

abstract class AbstractTest extends TestCase
{
    const API_TEST_ENDPOINT = 'https://api-public.sandbox.pro.coinbase.com';

    /**
     * @var RequestManager
     */
    protected $requestManager;
    /**
     * @var Time
     */
    protected $time;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        try {
            $dotenv = Dotenv::createImmutable(__DIR__.'/../../..');
            $dotenv->load();
        } catch (\Throwable $exception) {
            // We don't care, it is just a way between a lot to load envs
        }
        $apiParams = new ApiParams(
            self::API_TEST_ENDPOINT,
            $_ENV['API_KEY'] ?? $_SERVER['API_KEY'],
            $_ENV['API_SECRET'] ?? $_SERVER['API_SECRET'],
            $_ENV['API_PASSPHRASE'] ?? $_SERVER['API_PASSPHRASE']
        );
        if (self::API_TEST_ENDPOINT !== $apiParams->getEndPoint()) {
            $this->markTestSkipped('Looks like you\'re running tests on a non-testing API. Tests must be run on the test API, otherwise dangerous and undesirable effects could happen to your account. Never run on a non-testing API.');
        }
        if (!$this->retryIsConnected(3, 1)) {
            $this->markTestSkipped('Functional tests require an internet connection.');
        }
        ini_set('xdebug.var_display_max_depth', '16');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '4096');
        $httpClient = new Client();
        $this->requestManager = new RequestManager($httpClient, $apiParams);
        $this->time = new Time($this->requestManager);
        $this->requestManager->setTimeInterface($this->time);
        usleep(750000);
    }

    private function isConnected()
    {
        $en = $es = null;
        $connected = @fsockopen('dns.google', 443, $en, $es, 3);
        if (!$connected) {
            return false;
        }

        fclose($connected);

        return true;
    }

    private function retryIsConnected(int $numberOfRetry, int $delayBetweenRetryInSeconds)
    {
        while ($numberOfRetry--) {
            if ($this->isConnected()) {
                return true;
            }
            sleep($delayBetweenRetryInSeconds);
        }

        return false;
    }
}
