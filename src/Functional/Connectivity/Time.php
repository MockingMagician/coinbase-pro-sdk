<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TimeDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TimeData;

class Time extends AbstractConnectivity implements TimeInterface
{
    public function getTimeRaw(): string
    {
        return $this->getRequestFactory()->createRequest('GET', '/time')->setMustBeSigned(false)->send();
    }

    public function getTime(): TimeDataInterface
    {
        return TimeData::createFromJson($this->getTimeRaw());
    }
}
