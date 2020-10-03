<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Misc;

use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class Json
{
    public static function encode(array $value, int $options = 0, int $depth = 512): string
    {
        /** @var string $json */
        $json = \json_encode($value, $options, $depth);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new ApiError(json_last_error_msg());
        }

        return $json;
    }

    /**
     * @return mixed
     */
    public static function decode(string $json, bool $assoc = false, int $depth = 512, int $options = 0)
    {
        $data = \json_decode($json, $assoc, $depth, $options);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new ApiError(json_last_error_msg());
        }

        return $data;
    }
}
