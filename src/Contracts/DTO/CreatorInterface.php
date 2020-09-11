<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

interface CreatorInterface
{
    public static function createFromArray(array $array);

    public static function createFromJson(string $json);

    /**
     * @param string $json
     * @return self[]
     */
    public static function createCollectionFromJson(string $json): array;
}
