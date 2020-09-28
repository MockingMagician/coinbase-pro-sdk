<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Api;

interface ApiConfigInterface
{
    public function connectivityConfig(): ApiConnectivityConfigInterface;

    public function setUseCoinbaseRemoteTime(bool $set): ApiConfigInterface;

    public function isUseCoinbaseRemoteTime(): bool;

    public function setManageRateLimits(bool $set): ApiConfigInterface;

    public function isManageRateLimits(): bool;
}
