<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

interface CreatorInterface
{
    /**
     * @param mixed[] $array
     * @param mixed ...$extraData
     * @return self
     */
    public static function createFromArray(array $array, ...$extraData);

    /**
     * @param string $json
     * @param mixed ...$extraData
     * @return self
     */
    public static function createFromJson(string $json, ...$extraData);

    /**
     * @param string $json
     * @param mixed ...$extraData
     * @return self[]
     */
    public static function createCollectionFromJson(string $json, ...$extraData): array;
}
