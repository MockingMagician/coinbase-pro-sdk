<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\TimeDataInterface;

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
