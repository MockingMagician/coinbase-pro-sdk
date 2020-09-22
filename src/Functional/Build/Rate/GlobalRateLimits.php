<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Build\Rate;


use MockingMagician\CoinbaseProSdk\Contracts\Build\GlobalRateLimitsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\RateLimitsInterface;

class GlobalRateLimits extends RateLimits implements GlobalRateLimitsInterface
{
    /**
     * @var RateLimitsInterface
     */
    private $publicRateLimit;
    /**
     * @var RateLimitsInterface
     */
    private $privateRateLimit;

    public function __construct(RateLimitsInterface $publicRateLimit, RateLimitsInterface $privateRateLimit, int $limit)
    {
        parent::__construct($limit);
        $this->publicRateLimit = $publicRateLimit;
        $this->privateRateLimit = $privateRateLimit;
    }

    public function recordPublicCallRequest(): void
    {
        $this->recordCallRequest();
        $this->publicRateLimit->recordCallRequest();
    }

    public function recordPrivateCallRequest(): void
    {
        $this->recordCallRequest();
        $this->privateRateLimit->recordCallRequest();
    }

    public function shouldWeWaitForPublicCallRequest(): bool
    {
        return $this->shouldWeWait() || $this->publicRateLimit->shouldWeWait();
    }

    public function shouldWeWaitForPrivateCallRequest(): bool
    {
        return $this->shouldWeWait() || $this->privateRateLimit->shouldWeWait();
    }
}
