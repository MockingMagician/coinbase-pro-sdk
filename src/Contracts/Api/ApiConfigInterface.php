<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Api;


interface ApiConfigInterface
{
    public function connectivityConfig(): ApiConnectivityConfigInterface;

    public function setUseCoinbaseRemoteTime(bool $set): ApiConfigInterface;

    public function isUseCoinbaseRemoteTime(): bool;

    public function setManageRateLimits(bool $set): ApiConfigInterface;

    public function isManageRateLimits(): bool;
}
