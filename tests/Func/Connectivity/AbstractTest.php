<?php


namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;


use Dotenv\Dotenv;
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

    public function setUp(): void
    {
        parent::setUp();
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
        $dotenv->load();
        $apiParams = new ApiParams($_ENV['API_ENDPOINT'], $_ENV['API_KEY'], $_ENV['API_KEY_SECRET'], $_ENV['API_KEY_PASSPHRASE']);
        $httpClient = new Client();
        $this->requestManager = new RequestManager($httpClient, $apiParams);
        $this->time = new Time($this->requestManager);
        $this->requestManager->setTimeInterface($this->time);
    }
}
