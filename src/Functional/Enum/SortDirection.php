<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Enum;


use Spatie\Enum\Enum;

/**
 * @method static self asc()
 * @method static self desc()
 */
class SortDirection extends Enum
{
    protected static function values(): array
    {
        return [
            'asc' => 'asc',
            'desc' => 'desc',
        ];
    }
}
