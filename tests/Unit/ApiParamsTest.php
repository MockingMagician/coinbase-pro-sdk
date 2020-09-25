<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Unit;

use MockingMagician\CoinbaseProSdk\Functional\Api\ApiParams;
use PHPUnit\Framework\TestCase;

/**
 * @covers MockingMagician\CoinbaseProSdk\Functional\Api\ApiParams
 */
class ApiParamsTest extends TestCase
{
    public function testGetter()
    {
        $endpoint = 'endpoint';
        $key = 'key';
        $secret = 'secret';
        $passphrase = 'passphrase';

        $apiParams = new ApiParams($endpoint, $key, $secret, $passphrase);

        self::assertEquals($endpoint, $apiParams->getEndPoint());
        self::assertEquals($key, $apiParams->getKey());
        self::assertEquals($secret, $apiParams->getSecret());
        self::assertEquals($passphrase, $apiParams->getPassphrase());
    }
}
