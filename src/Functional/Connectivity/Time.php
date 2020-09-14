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

class Time extends AbstractRequestManagerAware implements TimeInterface
{
    public function getTimeRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/time')->send();
    }

    public function getTime(): TimeDataInterface
    {
        return new TimeData($this->getTimeRaw());
    }
}
