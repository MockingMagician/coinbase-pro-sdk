<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Api\Config;

use GuzzleHttp\Client;
use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ConfigInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ConnectivityConfigInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ParamsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestFactoryInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Time;
use MockingMagician\CoinbaseProSdk\Functional\Request\RequestFactory;

abstract class AbstractConfig implements ConfigInterface
{
    /**
     * @var ConnectivityConfigInterface
     */
    protected $apiConnectivityConfig;
    /**
     * @var bool
     */
    protected $useCoinbaseRemoteTime;
    /**
     * @var bool
     */
    protected $manageRateLimits;
    /**
     * @var ParamsInterface
     */
    protected $params;
    /**
     * @var bool
     */
    private $useSecurityLayerForParams;

    protected function __construct(
        string $endpoint,
        string $key,
        string $secret,
        string $passphrase,
        bool $useCoinbaseRemoteTime = false,
        bool $manageRateLimits = true,
        bool $useSecurityLayerForParams = true
    ) {
        $this->params = new Params(
            $endpoint,
            $key,
            $secret,
            $passphrase
        );
        $this->apiConnectivityConfig = new ConnectivityConfig();
        $this->useCoinbaseRemoteTime = $useCoinbaseRemoteTime;
        $this->manageRateLimits = $manageRateLimits;
        $this->useSecurityLayerForParams = $useSecurityLayerForParams;
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

    public function setUseSecurityLayerForParams(bool $set): ConfigInterface
    {
        $this->useSecurityLayerForParams = $set;

        return $this;
    }

    public function isUseSecurityLayerForParams(): bool
    {
        return $this->useSecurityLayerForParams;
    }

    public function getBuildRequestFactory(): RequestFactoryInterface
    {
        $params = $this->params;

        if ($this->isUseSecurityLayerForParams()) {
            $params = new SecureParams($params);
        }

        $requestFactory = new RequestFactory(new Client(), $params, $this->isManageRateLimits());

        if ($this->isUseCoinbaseRemoteTime()) {
            $requestFactory->setTimeInterface(new Time($requestFactory));
        }

        return $requestFactory;
    }
}
