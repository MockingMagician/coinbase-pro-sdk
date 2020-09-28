<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\Api;

use MockingMagician\CoinbaseProSdk\Functional\Api\ApiParams;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\Api\ApiParams
 *
 * @internal
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
