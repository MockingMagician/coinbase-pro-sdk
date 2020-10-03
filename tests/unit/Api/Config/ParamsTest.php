<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\Api\Config;

use MockingMagician\CoinbaseProSdk\Functional\Api\Config\Params;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\Api\Config\Params
 *
 * @internal
 */
class ParamsTest extends TestCase
{
    public function testGetter()
    {
        $endpoint = 'endpoint';
        $key = 'key';
        $secret = 'secret';
        $passphrase = 'passphrase';

        $apiParams = new Params($endpoint, $key, $secret, $passphrase);

        self::assertEquals($endpoint, $apiParams->getEndPoint());
        self::assertEquals($key, $apiParams->getKey());
        self::assertEquals($secret, $apiParams->getSecret());
        self::assertEquals($passphrase, $apiParams->getPassphrase());
    }
}
