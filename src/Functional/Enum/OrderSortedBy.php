<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Enum;


use Spatie\Enum\Enum;

/**
 * @method static self createdAt()
 * @method static self price()
 * @method static self size()
 * @method static self orderId()
 * @method static self side()
 * @method static self type()
 */
class OrderSortedBy extends Enum
{
    protected static function values(): array
    {
        return [
            'createdAt' => 'created_at',
            'price' => 'price',
            'size' => 'size',
            'orderId' => 'order_id',
            'side' => 'side',
            'type' => 'type',
        ];
    }
}
