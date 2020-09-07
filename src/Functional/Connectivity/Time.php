<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TimeDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TimeData;

class Time extends AbstractRequestManagerAware implements TimeInterface
{
    public function getTimeRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/time', null)->send();
    }

    public function getTime(): TimeDataInterface
    {
        return new TimeData($this->getTimeRaw());
    }
}
