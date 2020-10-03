<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Api\Config;


use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ConfigInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ConnectivityConfigInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ParamsInterface;

class Config implements ConfigInterface
{
    /**
     * @var ConnectivityConfigInterface
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
    /**
     * @var ParamsInterface
     */
    private $params;

    public function __construct(
//        string $endpoint,
//        string $key,
//        string $secret,
//        string $passphrase,
        bool $useCoinbaseRemoteTime = false,
        bool $manageRateLimits = true
    ) {
//        $this->params = new Params(
//            $endpoint,
//            $key,
//            $secret,
//            $passphrase
//        );
        $this->apiConnectivityConfig = new ConnectivityConfig();
        $this->useCoinbaseRemoteTime = $useCoinbaseRemoteTime;
        $this->manageRateLimits = $manageRateLimits;
    }

    /**
     * {@inheritdoc}
     */
    public function getConnectivityConfig(): ConnectivityConfigInterface
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
    public function setUseCoinbaseRemoteTime(bool $useCoinbaseRemoteTime): ConfigInterface
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
    public function setManageRateLimits(bool $manageRateLimits): ConfigInterface
    {
        $this->manageRateLimits = $manageRateLimits;

        return $this;
    }

    public function getParams(): ParamsInterface
    {
        return $this->params;
    }
}
