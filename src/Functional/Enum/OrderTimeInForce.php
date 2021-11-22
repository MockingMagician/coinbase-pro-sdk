<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Enum;

use Spatie\Enum\Enum;

/**
 * Time in force policies provide guarantees about the lifetime of an order.
 * There are four policies: good till canceled GTC, good till time GTT, immediate or cancel IOC, and fill or kill FOK.
 *
 * GTC Good till canceled orders remain open on the book until canceled. This is the default behavior if no policy is specified.
 *
 * GTT Good till time orders remain open on the book until canceled or the allotted cancel_after is depleted on the matching engine. GTT orders are guaranteed to cancel before any other order is processed after the cancel_after timestamp which is returned by the API. A day is considered 24 hours.
 *
 * IOC Immediate or cancel orders instantly cancel the remaining size of the limit order instead of opening it on the book.
 *
 * FOK Fill or kill orders are rejected if the entire size cannot be matched.
 *
 * Note, match also refers to self trades.
 *
 * @method static self goodTillCancelled()
 * @method static self goodTillTime()
 * @method static self immediateOrCancel()
 * @method static self fillOrKill()
 */
class OrderTimeInForce extends Enum
{
    protected static function values(): array
    {
        return [
            'goodTillCancelled' => 'GTC',
            'goodTillTime' => 'GTT',
            'immediateOrCancel' => 'IOC',
            'fillOrKill' => 'FOK',
        ];
    }
}
