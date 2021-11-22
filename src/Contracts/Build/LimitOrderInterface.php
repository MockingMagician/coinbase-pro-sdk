<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Build;

/**
 * Interface LimitOrderToPlace.
 */
interface LimitOrderInterface extends OrderInterface
{
    /*
     * TIME IN FORCE
     *
     * Time in force policies provide guarantees about the lifetime of an order.
     * There are four policies:
     * good till canceled GTC,
     * good till time GTT,
     * immediate or cancel IOC,
     * and fill or kill FOK.
     *
     * GTC Good till canceled orders remain open on the book until canceled.
     * This is the default behavior if no policy is specified.
     *
     * GTT Good till time orders remain open on the book until canceled
     * or the allotted cancel_after is depleted on the matching engine.
     * GTT orders are guaranteed to cancel before any other order is processed
     * after the cancel_after timestamp which is returned by the API.
     * A day is considered 24 hours.
     *
     * IOC Immediate or cancel orders instantly cancel the remaining size of the limit order instead of opening it on the book.
     *
     * FOK Fill or kill orders are rejected if the entire size cannot be matched.
     *
     * Note, match also refers to self trades.
     */
    const TIME_IN_FORCE_GOOD_TILL_CANCELED = 'GTC';
    const TIME_IN_FORCE_GOOD_TILL_TIME = 'GTT';
    const TIME_IN_FORCE_IMMEDIATE_OR_CANCEL = 'IOC';
    const TIME_IN_FORCE_FILL_OR_KILL = 'FOK';
    const TIMES_IN_FORCE = [
        self::TIME_IN_FORCE_GOOD_TILL_CANCELED,
        self::TIME_IN_FORCE_GOOD_TILL_TIME,
        self::TIME_IN_FORCE_IMMEDIATE_OR_CANCEL,
        self::TIME_IN_FORCE_FILL_OR_KILL,
    ];

    const CANCEL_AFTER_MIN = 'min';
    const CANCEL_AFTER_HOUR = 'hour';
    const CANCEL_AFTER_DAY = 'day';

    const CANCELS_AFTER = [
        self::CANCEL_AFTER_MIN,
        self::CANCEL_AFTER_HOUR,
        self::CANCEL_AFTER_DAY,
    ];

    public function getPrice(): float;

    public function getSize(): float;

    public function getTimeInForce(): ?string;

    public function getCancelAfter(): ?string;

    public function isPostOnly(): bool;
}
