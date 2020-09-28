<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

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
     * {@inheritdoc}
     */
    public function connectivityConfig(): ApiConnectivityConfigInterface
    {
        return $this->apiConnectivityConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function isUseCoinbaseRemoteTime(): bool
    {
        return $this->useCoinbaseRemoteTime;
    }

    /**
     * {@inheritdoc}
     */
    public function setUseCoinbaseRemoteTime(bool $useCoinbaseRemoteTime): ApiConfigInterface
    {
        $this->useCoinbaseRemoteTime = $useCoinbaseRemoteTime;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isManageRateLimits(): bool
    {
        return $this->manageRateLimits;
    }

    /**
     * {@inheritdoc}
     */
    public function setManageRateLimits(bool $manageRateLimits): ApiConfigInterface
    {
        $this->manageRateLimits = $manageRateLimits;

        return $this;
    }
}
