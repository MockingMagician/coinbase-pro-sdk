<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\CreatorInterface;

abstract class AbstractCreator implements CreatorInterface
{
    abstract public static function createFromArray(array $array)

    public static function createFromJson(string $json)
    {
        return static::createFromArray(json_decode($json));
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollectionFromJson(string $json): array
    {
        $collection = json_decode($json, true);
        foreach ($collection as $k => &$value) {
            $collection[$k] = static::createFromArray($value);
        }

        return $collection;
    }
}
