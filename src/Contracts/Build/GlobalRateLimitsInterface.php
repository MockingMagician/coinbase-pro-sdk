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
 * FINANCIAL INFORMATION EXCHANGE API
 * The FIX API throttles the number of incoming messages to 50 commands per second.
 * A maximum of 5 connections can be established per profile.
 *
 * Explanation :
 *
 * What does it all mean?
 *
 * Only 5 private / 6 public requests per second are accepted
 *
 * AND only 10 per seconds considering all APIs (public and private)
 *
 * In practice, if we push 10 requests per second, then we will have to wait 2 seconds before
 * making new requests in order to be in a ratio of 5 requests per second.
 */
interface GlobalRateLimitsInterface extends RateLimitsInterface
{
    public function recordPublicCallRequest(): void;
    public function recordPrivateCallRequest(): void;
    public function shouldWeWaitForPublicCallRequest(): bool;
    public function shouldWeWaitForPrivateCallRequest(): bool;
}
