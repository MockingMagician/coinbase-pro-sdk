<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Class FeeDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * According to doc :
 *
 * [
 *   {
 *     "maker_fee_rate": "0.0015",
 *     "taker_fee_rate": "0.0025",
 *     "usd_volume": "25000.00"
 *   }
 * ]
 *
 * returned by test api :
 *
 *   {
 *     "maker_fee_rate": "0.0015",
 *     "taker_fee_rate": "0.0025",
 *     "usd_volume": "25000.00"
 *   }
 *
 */
interface FeeDataInterface
{
    public function getMakerFeeRate(): float;
    public function getTakerFeeRate(): float;
    public function getUsdVolume(): float;
}
