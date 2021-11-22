<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Enum;

use Spatie\Enum\Enum;

/**
 * When placing an order, you can specify the order type.
 * The order type you specify will influence which other order parameters are required as well as how your order will be executed by the matching engine.
 * If type is not specified, the order will default to a limit order.
 *
 * limit orders are both the default and basic order type. A limit order requires specifying a price and size.
 * The size is the number of bitcoin to buy or sell, and the price is the price per bitcoin.
 * The limit order will be filled at the price specified or better.
 * A sell order can be filled at the specified price per bitcoin or a higher price per bitcoin and a buy order can be filled at the specified price or a lower price depending on market conditions.
 * If market conditions cannot fill the limit order immediately,
 * then the limit order will become part of the open order book until filled by another incoming order or canceled by the user.
 *
 * market orders differ from limit orders in that they provide no pricing guarantees.
 * They however do provide a way to buy or sell specific amounts of bitcoin or fiat without having to specify the price.
 * Market orders execute immediately and no part of the market order will go on the open order book.
 * Market orders are always considered takers and incur taker fees. When placing a market order you can specify funds and/or size.
 * Funds will limit how much of your quote currency account balance is used and size will limit the bitcoin amount transacted.
 *
 * Stop orders become active and wait to trigger based on the movement of the last trade price.
 * There are two types of stop orders, stop loss and stop entry:
 * stop: 'loss': Triggers when the last trade price changes to a value at or below the stop_price.
 * stop: 'entry': Triggers when the last trade price changes to a value at or above the stop_price.
 * The last trade price is the last price at which an order was filled.
 * This price can be found in the latest match message.
 * Note that not all match messages may be received due to dropped messages.
 * Note that when stop orders are triggered, they execute as limit orders and are therefore subject to holds.
 *
 * @method static self limit()
 * @method static self market()
 * @method static self stop()
 */
class OrderType extends Enum
{
    protected static function values(): array
    {
        return [
            'limit' => 'limit',
            'market' => 'market',
            'stop' => 'stop',
        ];
    }
}
