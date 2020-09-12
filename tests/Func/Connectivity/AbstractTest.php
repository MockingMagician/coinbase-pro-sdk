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
        if (!$this->retryIsConnected(3, 1)) {
            $this->markTestSkipped('Functional tests require internet connection');
        }
        ini_set('xdebug.var_display_max_depth', '16');
        ini_set('xdebug.var_display_max_children', '128');
        ini_set('xdebug.var_display_max_data', '1024');
        parent::setUp();
        $dotenv = Dotenv::createImmutable(__DIR__.'/../../..');
        $dotenv->load();
        $apiParams = new ApiParams($_ENV['API_ENDPOINT'], $_ENV['API_KEY'], $_ENV['API_KEY_SECRET'], $_ENV['API_KEY_PASSPHRASE']);
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
