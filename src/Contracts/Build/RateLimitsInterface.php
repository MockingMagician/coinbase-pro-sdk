<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Build;

/**
 * Interface RateLimitsInterface
 *
 * Rate Limits
 * When a rate limit is exceeded, a status of 429 Too Many Requests will be returned.
 *
 * REST API
 *
 * PUBLIC ENDPOINTS
 * We throttle public endpoints by IP: 3 requests per second, up to 6 requests per second in bursts.
 * Some endpoints may have custom rate limits.
 *
 * PRIVATE ENDPOINTS
 * We throttle private endpoints by profile ID: 5 requests per second, up to 10 requests per second in bursts.
 * Some endpoints may have custom rate limits.
 *
 * Explanation :
 *
 * What does it all mean?
 *
 * Only 5 private / 6 public requests per second are accepted
 *
 * AND only 10 per seconds considering all APIs (public and private)
 */
interface RateLimitsInterface
{
    public function recordCallRequest(): void;
    public function shouldWeWait(): bool;
    public function getLimit(): int;
}
