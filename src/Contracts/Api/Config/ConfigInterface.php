<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Api\Config;

interface ConfigInterface
{
    public function getConnectivityConfig(): ConnectivityConfigInterface;

    public function setUseCoinbaseRemoteTime(bool $set): ConfigInterface;

    public function isUseCoinbaseRemoteTime(): bool;

    public function setManageRateLimits(bool $set): ConfigInterface;

    public function isManageRateLimits(): bool;

    public function getParams(): ParamsInterface;
}
