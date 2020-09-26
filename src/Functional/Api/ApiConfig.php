<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Api;


use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiConfigInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiConnectivityConfigInterface;

class ApiConfig implements ApiConfigInterface
{
    /**
     * @var ApiConnectivityConfigInterface
     */
    private $apiConnectivityConfig;
    /**
     * @var bool
     */
    private $useCoinbaseRemoteTime;
    /**
     * @var bool
     */
    private $manageRateLimits;

    public function __construct(
        bool $useCoinbaseRemoteTime = false,
        bool $manageRateLimits = true
    ) {
        $this->apiConnectivityConfig = new ApiConnectivityConfig();
        $this->useCoinbaseRemoteTime = $useCoinbaseRemoteTime;
        $this->manageRateLimits = $manageRateLimits;
    }

    /**
     * @inheritDoc
     */
    public function connectivityConfig(): ApiConnectivityConfigInterface
    {
        return $this->apiConnectivityConfig;
    }

    /**
     * @inheritDoc
     */
    public function isUseCoinbaseRemoteTime(): bool
    {
        return $this->useCoinbaseRemoteTime;
    }

    /**
     * @inheritDoc
     */
    public function setUseCoinbaseRemoteTime(bool $useCoinbaseRemoteTime): ApiConfigInterface
    {
        $this->useCoinbaseRemoteTime = $useCoinbaseRemoteTime;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isManageRateLimits(): bool
    {
        return $this->manageRateLimits;
    }

    /**
     * @inheritDoc
     */
    public function setManageRateLimits(bool $manageRateLimits): ApiConfigInterface
    {
        $this->manageRateLimits = $manageRateLimits;

        return $this;
    }
}
