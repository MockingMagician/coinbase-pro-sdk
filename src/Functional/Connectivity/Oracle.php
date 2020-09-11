<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

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
     * {@inheritdoc}
     */
    public function getCryptographicallySignedPrices(): OracleCryptoSignedPricesInterface
    {
        return OracleCryptoSignedPrices::createFromJson($this->getCryptographicallySignedPricesRaw());
    }
}
