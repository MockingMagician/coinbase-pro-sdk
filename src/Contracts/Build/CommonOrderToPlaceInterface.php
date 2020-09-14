<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Build;

/**
 * Class CommonOrderToMakeInterface.
 */
interface CommonOrderToPlaceInterface
{
    const SIDE_BUY = 'buy';
    const SIDE_SELL = 'sell';
    const SIDES = [
        self::SIDE_BUY,
        self::SIDE_SELL,
    ];

    const TYPE_LIMIT = 'limit'; //default
    const TYPE_MARKET = 'market';
    const TYPES = [
        self::TYPE_LIMIT,
        self::TYPE_MARKET,
    ];

    /*
     * SELF-TRADE PREVENTION
     * Self-trading is not allowed on Coinbase Pro.
     * Two orders from the same user will not be allowed to match with one another.
     * To change the self-trade behavior, specify the stp flag.
     *
     * Flag	Name
     * dc	Decrease and Cancel (default)
     * co	Cancel oldest
     * cn	Cancel newest
     * cb	Cancel both
     */
    const SELF_TRADE_PREVENTION_DECREASE_AND_CANCEL = 'dc'; //default
    const SELF_TRADE_PREVENTION_CANCEL_OLDEST = 'co';
    const SELF_TRADE_PREVENTION_CANCEL_NEWEST = 'cn';
    const SELF_TRADE_PREVENTION_CANCEL_BOTH = 'cb';
    const SELF_TRADE_PREVENTIONS = [
        self::SELF_TRADE_PREVENTION_DECREASE_AND_CANCEL,
        self::SELF_TRADE_PREVENTION_CANCEL_OLDEST,
        self::SELF_TRADE_PREVENTION_CANCEL_NEWEST,
        self::SELF_TRADE_PREVENTION_CANCEL_BOTH,
    ];

    /*
     * STOP ORDERS
     * Stop orders become active and wait to trigger based on the movement of the last trade price.
     * There are two types of stop orders, stop loss and stop entry:
     *
     * stop: 'loss': Triggers when the last trade price changes to a value at or below the stop_price.
     * stop: 'entry': Triggers when the last trade price changes to a value at or above the stop_price.
     *
     * The last trade price is the last price at which an order was filled.
     * This price can be found in the latest match message.
     * Note that not all match messages may be received due to dropped messages.
     *
     * Note that when stop orders are triggered, they execute as limit orders and are therefore subject to holds.
     */
    const STOP_LOSS = 'loss';
    const STOP_ENTRY = 'entry';
    const STOPS = [
        self::STOP_ENTRY,
        self::STOP_LOSS,
    ];

    public function getType(): string;

    public function getSide(): string;

    public function getProductId(): string;

    public function getSelfTradePrevention(): ?string;

    public function getStop(): ?string;

    public function getStopPrice(): ?float;

    public function getClientOrderId(): ?string;

    public function getBodyForRequest(): array;
}
