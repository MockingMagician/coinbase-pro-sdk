<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Enum;

use Spatie\Enum\Enum;

/**
 * Self-trading is not allowed on Coinbase Exchange.
 * Two orders from the same user will not be allowed to match with one another.
 * To change the self-trade behavior, specify the stp flag.
 *
 * Flag	Name
 * dc	Decrease and Cancel (default)
 * co	Cancel oldest
 * cn	Cancel newest
 * cb	Cancel both
 *
 * @method static self decreaseAndCancel()
 * @method static self cancelOldest()
 * @method static self cancelNewest()
 * @method static self cancelBoth()
 */
class OrderSelfTradePrevention extends Enum
{
    protected static function values(): array
    {
        return [
            'decreaseAndCancel' => 'dc',
            'cancelOldest' => 'co',
            'cancelNewest' => 'cn',
            'cancelBoth' => 'cb',
        ];
    }
}
