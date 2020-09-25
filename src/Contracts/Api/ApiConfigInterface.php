<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Api;


interface ApiConfigInterface
{
    public function connectivityConfig(): ApiConnectivityConfigInterface;

    public function setUseCoinbaseRemoteTime(): ApiConfigInterface;

    public function getUseCoinbaseRemoteTime(): bool;

    public function setManageRateLimits(): ApiConfigInterface;

    public function getManageRateLimits(): bool;
}
