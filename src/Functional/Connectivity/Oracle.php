<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\OracleInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OracleCryptoSignedPricesInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\OracleCryptoSignedPrices;

class Oracle extends AbstractRequestManagerAware implements OracleInterface
{
    public function getCryptographicallySignedPricesRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/oracle')->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function getCryptographicallySignedPrices(): OracleCryptoSignedPricesInterface
    {
        return OracleCryptoSignedPrices::createFromJson($this->getCryptographicallySignedPricesRaw());
    }
}
