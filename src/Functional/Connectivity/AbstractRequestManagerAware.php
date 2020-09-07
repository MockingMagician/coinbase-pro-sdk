<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\RequestManagerInterface;

class AbstractRequestManagerAware
{
    /**
     * @var RequestManagerInterface
     */
    private $requestManager;

    public function __construct(RequestManagerInterface $requestManager)
    {
        $this->requestManager = $requestManager;
    }

    /**
     * @return RequestManagerInterface
     */
    protected function getRequestManager(): RequestManagerInterface
    {
        return $this->requestManager;
    }
}
