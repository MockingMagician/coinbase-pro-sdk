<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/***
 * Interface Stats24hrDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * {
 *   "open": "6745.61000000",
 *   "high": "7292.11000000",
 *   "low": "6650.00000000",
 *   "volume": "26185.51325269",
 *   "last": "6813.19000000",
 *   "volume_30day": "1019451.11188405"
 * }
 */
interface ProductStats24hrDataInterface
{
    public function getOpen(): float;
    public function getHigh(): float;
    public function getLow(): float;
    public function getVolume(): float;
    public function getLast(): float;
    public function getVolume30day(): float;
}
