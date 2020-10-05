<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\CreatorInterface;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

abstract class AbstractCreator implements CreatorInterface
{
    /**
     * {@inheritdoc}
     */
    abstract public static function createFromArray(array $array, ...$extraData);

    /**
     * {@inheritdoc}
     */
    public static function createFromJson(string $json, ...$extraData)
    {
        return static::createFromArray(Json::decode($json, true));
    }

    /**
     * {@inheritdoc}
     */
    public static function createCollectionFromJson(string $json, ...$extraData): array
    {
        $collection = Json::decode($json, true);
        foreach ($collection as $k => $value) {
            $collection[$k] = static::createFromArray($value);
        }

        return $collection;
    }

    /**
     * @param mixed[] $array
     * @param mixed   ...$extraData
     *
     * @return static[]
     */
    public static function createCollectionFromArray(array $array, ...$extraData): array
    {
        foreach ($array as $k => $value) {
            $array[$k] = static::createFromArray($value);
        }

        return $array;
    }
}
