<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Enum;

use Spatie\Enum\Enum;

/**
 * @method static self min()
 * @method static self hour()
 * @method static self day()
 */
class OrderCancelAfter extends Enum
{
    protected static function values(): array
    {
        return [
            'min' => 'min',
            'hour' => 'hour',
            'day' => 'day',
        ];
    }
}
