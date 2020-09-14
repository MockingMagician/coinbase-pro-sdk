<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Class VolumeDataInterface.
 */
interface VolumeDataInterface
{
    public function getProductId(): string;
    public function getExchangeVolume(): float;
    public function getVolume(): float;
    public function getRecordedAt(): DateTimeInterface;
}
