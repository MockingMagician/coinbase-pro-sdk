<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface CurrencyInfoData.
 */
interface CurrencyDataInterface
{
    const FIELDS = ['id', 'name', 'min_size'];

    public function getId(): string;

    public function getName(): string;

    public function getMinSize(): float;

    public function getExtraData(): array;
}
