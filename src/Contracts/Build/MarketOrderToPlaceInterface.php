<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Build;

/**
 * Interface MarketOrderToPlace
 * @package MockingMagician\CoinbaseProSdk\Contracts
 *
 * MARKET ORDER PARAMETERS
 * Param	Description
 * size	[optional]* Desired amount in base currency
 * funds	[optional]* Desired amount of quote currency to use
 *
 * One of size or funds is required.
 */
interface MarketOrderToPlaceInterface extends CommonOrderToPlaceInterface
{
    public function getSize(): ?float;
    public function getFunds(): ?float;
}
