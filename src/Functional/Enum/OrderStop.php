<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Enum;


use Spatie\Enum\Enum;

/**
 * @method static self buy()
 * @method static self sell()
 */
class OrderStop extends Enum
{
    protected static function values(): array
    {
        return [
            'buy' => 'buy',
            'sell' => 'sell',
        ];
    }
}
