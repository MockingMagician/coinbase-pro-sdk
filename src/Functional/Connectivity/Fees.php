<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\FeesInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\FeeDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\FeeData;

class Fees extends AbstractRequestManagerAware implements FeesInterface
{
    public function getCurrentFeesRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/fees')->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function getCurrentFees(): FeeDataInterface
    {
        return FeeData::createFromJson($this->getCurrentFeesRaw());
    }
}
