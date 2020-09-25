<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestFactoryInterface;

class AbstractRequestManagerAware
{
    /**
     * @var RequestFactoryInterface
     */
    private $requestManager;

    public function __construct(RequestFactoryInterface $requestManager)
    {
        $this->requestManager = $requestManager;
    }

    protected function getRequestManager(): RequestFactoryInterface
    {
        return $this->requestManager;
    }
}
