<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Build\Rate;


use MockingMagician\CoinbaseProSdk\Contracts\Build\RateLimitsInterface;

class NullRateLimits implements RateLimitsInterface
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
}
