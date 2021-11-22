<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Enum;


use Spatie\Enum\Enum;

/**
 * @method static self open()
 * @method static self pending()
 * @method static self rejected()
 * @method static self done()
 * @method static self active()
 * @method static self received()
 * @method static self all()
 */
class OrderStatus extends Enum
{
    protected static function values(): array
    {
        return [
            'open' => ['open'],
            'pending' => ['pending'],
            'rejected' => ['rejected'],
            'done' => ['done'],
            'active' => ['active'],
            'received' => ['received'],
            'all' => [
                'open',
                'pending',
                'rejected',
                'done',
                'active',
                'received',
            ],
        ];
    }
}
