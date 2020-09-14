<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Build;

/**
 * Interface MarketOrderToPlace.
 */
interface MarketOrderToPlaceInterface extends CommonOrderToPlaceInterface
{
    public function getSize(): ?float;

    public function getFunds(): ?float;
}
