<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface MarginStatusData
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * {
 *   "tier": 0,
 *   "enabled": true,
 *   "eligible": true
 * }
 */
interface MarginStatusDataInterface
{
    public function getTier(): int;
    public function isEnabled(): bool;
    public function isEligible(): bool;
}
