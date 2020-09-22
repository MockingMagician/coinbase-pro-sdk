<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Build\Rate;


use MockingMagician\CoinbaseProSdk\Contracts\Build\GlobalRateLimitsInterface;

class NullGlobalRateLimits implements GlobalRateLimitsInterface
{
    public function recordCallRequest(): void
    {
        return;
    }

    public function shouldWeWait(): bool
    {
        return false;
    }

    public function getLimit(): int
    {
        return -1;
    }

    public function recordPublicCallRequest(): void
    {
        return;
    }

    public function recordPrivateCallRequest(): void
    {
        return;
    }

    public function shouldWeWaitForPublicCallRequest(): bool
    {
        return false;
    }

    public function shouldWeWaitForPrivateCallRequest(): bool
    {
        return false;
    }
}
