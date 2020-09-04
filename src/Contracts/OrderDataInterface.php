<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


interface OrderDataInterface
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

    /*
     * GoodTillCancel (GTC)
     * This is a type of Time in Force order that is placed by a trader to purchase or sell at a particular price
     * which remains active until it’s cancelled by the trader.
     *
     * In other words, a trader will choose GTC when he/she is willing to wait until the full quantity of the order is filled.
     * At the same time, the trader enjoys the flexibility to cancel unfilled quantity at any time.
     *
     * ImmediateOrCancel (IOC)
     * An ImmediateOrCancel order (IOC) is an order to buy or sell at the limit price that executes all
     * or part immediately and cancels any unfilled portion of the order. If the order can't be filled immediately,
     * even partially, it will be cancelled immediately.
     *
     * Traders typically use IOC orders when submitting a large order to avoid having it filled at an array of prices.
     * An IOC order automatically cancels any part of the order that doesn’t fill immediately.
     * IOC orders help traders to limit risk, speed execution and provide price improvement by providing greater flexibility.
     *
     * Assume, for example, that a trader places a Sell/Short limit order at US$10,500 at 10,000 contracts with IOC time in force strategy.
     * When the market price goes to US$10,500, there are only 5,000 Buy/Long orders.
     * Therefore, DueDEX will match buy and sell at US$ 10,500 for 5,000 contracts.
     * While the remaining 5,000 contracts of Sell/Short will be cancelled.
     *
     * FillOrKill (FOK)
     * Fill or kill (FOK) is a type of Time in Force designation used by traders that instructs a trading platform
     * to execute a transaction at Limit Price or better immediately and completely, or not at all.
     * This type of order is most often used by active traders and is usually for a large quantity of stock.
     * The purpose of a fill or kill (FOK) order is to ensure that a position is entered at a desired price.
     *
     * Good Till Trigger (GTT)
     * These Terms of Use govern the usage of services of the GTT Feature.
     * By agreeing to use this GTT Feature terms, you agree to have read and understood these clauses,
     * conditions, the modalities of how the GTT Feature clearly works,
     * and Zerodha’s policies, procedures and risk disclosure documents.
     */
    const TIME_IN_FORCE_GOOD_TILL_CANCELED = 'GTC';
    const TIME_IN_FORCE_GOOD_TILL_TRIGGER = 'GTT';
    const TIME_IN_FORCE_IMMEDIATE_OR_CANCEL = 'IOC';
    const TIME_IN_FORCE_FILL_OR_KILL = 'FOK';
    const TIMES_IN_FORCE = [
        self::TIME_IN_FORCE_GOOD_TILL_CANCELED,
        self::TIME_IN_FORCE_GOOD_TILL_TRIGGER,
        self::TIME_IN_FORCE_IMMEDIATE_OR_CANCEL,
        self::TIME_IN_FORCE_FILL_OR_KILL,
    ];

    public function getId(): string;

    /**
     * CLIENT ORDER ID
     * The optional client_oid field must be a UUID generated by your trading application.
     * This field value will be broadcast in the public feed for received messages.
     * You can use this field to identify your orders in the public feed.
     * The client_oid is different than the server-assigned order id.
     * If you are consuming the public feed and see a received message with your client_oid,
     * you should record the server-assigned order_id as it will be used for future order status updates.
     * The client_oid will NOT be used after the received message is sent.
     *
     * The server-assigned order id is also returned as the id field to this HTTP POST request.
     *
     * @return string|null
     */
    public function getClientOderId(): ?string;

    /**
     * PRODUCT ID
     * The product_id must match a valid product. The products list is available via the /products endpoint.
     * @return string
     */
    public function getProductId(): string;

    /**
     * TYPE
     * When placing an order, you can specify the order type.
     * The order type you specify will influence which other order parameters are required
     * as well as how your order will be executed by the matching engine.
     * If type is not specified, the order will default to a limit order.
     *
     * limit orders are both the default and basic order type. A limit order requires specifying a price and size.
     * The size is the number of base currency to buy or sell, and the price is the price per base currency.
     * The limit order will be filled at the price specified or better.
     * A sell order can be filled at the specified price per base currency or a higher price per base currency
     * and a buy order can be filled at the specified price or a lower price depending on market conditions.
     * If market conditions cannot fill the limit order immediately, then the limit order will become part of
     * the open order book until filled by another incoming order or canceled by the user.
     *
     * market orders differ from limit orders in that they provide no pricing guarantees.
     * They however do provide a way to buy or sell specific amounts of base currency or fiat without having to specify the price.
     * Market orders execute immediately and no part of the market order will go on the open order book.
     * Market orders are always considered takers and incur taker fees.
     * When placing a market order you can specify funds and/or size.
     * Funds will limit how much of your quote currency account balance is used and size will limit the amount of
     * base currency transacted.
     *
     * @return string
     */
    public function getType(): string;

    public function getSelfTradePrevention(): string;

    /**
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
     *
     * @return string|null
     */
    public function getStop(): ?string;

    public function getStopPrice(): ?float;

    /**
     * PRICE
     * The price must be specified in quote_increment product units.
     * The quote increment is the smallest unit of price.
     * For example, the BTC-USD product has a quote increment of 0.01 or 1 penny.
     * Prices less than 1 penny will not be accepted, and no fractional penny prices will be accepted.
     * Not required for market orders.
     *
     * @return float|null
     */
    public function getPrice(): ?float;

    /**
     * SIZE
     * The size must be greater than the base_min_size for the product and no larger than the base_max_size.
     * The size can be in incremented in units of base_increment.
     * size indicates the amount of BTC (or base currency) to buy or sell.
     *
     * @return float
     */
    public function getSize(): float;

    /**
     * @return string
     */
    public function getTimeInForce(): string;

}
