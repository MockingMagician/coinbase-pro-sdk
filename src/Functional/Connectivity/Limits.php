<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\LimitsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\LimitsDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\LimitsData;

class Limits extends AbstractRequestManagerAware implements LimitsInterface
{
    public function getCurrentExchangeLimitsRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/users/self/exchange-limits')->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function getCurrentExchangeLimits(): LimitsDataInterface
    {
        return LimitsData::createFromJson($this->getCurrentExchangeLimitsRaw());
    }
}
