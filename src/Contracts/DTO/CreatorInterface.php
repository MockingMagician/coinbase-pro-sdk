<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

interface CreatorInterface
{
    public static function createFromArray(array $array, ...$divers);

    public static function createFromJson(string $json, ...$divers);

    /**
     * @param array $divers
     *
     * @return self[]
     */
    public static function createCollectionFromJson(string $json, ...$divers): array;
}
