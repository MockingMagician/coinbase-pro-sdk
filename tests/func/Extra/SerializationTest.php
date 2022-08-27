<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Extra;

use MockingMagician\CoinbaseProSdk\CoinbaseFacade;
use MockingMagician\CoinbaseProSdk\Functional\Api\CoinbaseApi;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class SerializationTest extends TestCase
{
    public function testSerializeCoinbaseFacadeWork(): void
    {
        $coinbase = new CoinbaseFacade();

        self::assertEquals($coinbase, unserialize(serialize($coinbase)));
    }

    public function testSerializeCoinbaseApiWork(): void
    {
        $api = CoinbaseFacade::createDefaultCoinbaseApi(
            'endpoint',
            'key',
            'secret',
            'passphrase'
        );

        $unserializedApi = unserialize(serialize($api));

        // equality can not be quickly tested cause to cipher that change at deserialization
        self::assertInstanceOf(CoinbaseApi::class, $unserializedApi);
    }
}
