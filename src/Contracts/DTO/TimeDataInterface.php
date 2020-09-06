<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface TimeDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * {
 *   "iso": "2015-01-07T23:47:25.201Z",
 *   "epoch": 1420674445.201
 * }
 */
interface TimeDataInterface
{
    public function getIso(): string;
    public function getEpoch(): float;
}
