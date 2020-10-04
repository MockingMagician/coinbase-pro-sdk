<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\TimeDataInterface;

/**
 * @internal
 */
class TimeTest extends AbstractTest
{
    public function testTimeRaw()
    {
        $raw = $this->time->getTimeRaw();
        self::assertStringContainsString('iso', $raw);
        self::assertStringContainsString('epoch', $raw);
    }

    public function testTime()
    {
        $time = $this->time->getTime();
        self::assertInstanceOf(TimeDataInterface::class, $time);
        self::assertIsString($time->getIso());
        self::assertIsFloat($time->getEpoch());
    }
}
