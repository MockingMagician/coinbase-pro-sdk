<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\HistoricRateDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderBookDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProductDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TickerSnapshotDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\Stats24hrDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TradeDataInterface;

interface ProductsInterface
{
    const LEVEL_ONE = 1;
    const LEVEL_TWO = 2;
    const LEVEL_THREE = 3;
    const LEVELS = [
        self::LEVEL_ONE,
        self::LEVEL_TWO,
        self::LEVEL_THREE,
    ];

    const GRANULARITY_MIN = 60;
    const GRANULARITY_FIVE_MIN = 300;
    const GRANULARITY_FIFTEEN_MIN = 900;
    const GRANULARITY_HOUR = 3600;
    const GRANULARITY_SIX_HOUR = 21600;
    const GRANULARITY_DAY = 86400;
    const GRANULARITY = [
        self::GRANULARITY_MIN,
        self::GRANULARITY_FIVE_MIN,
        self::GRANULARITY_FIFTEEN_MIN,
        self::GRANULARITY_HOUR,
        self::GRANULARITY_SIX_HOUR,
        self::GRANULARITY_DAY,
    ];

    /**
     * Get Products
     *
     * Get a list of available currency pairs for trading.
     *
     * HTTP REQUEST
     * GET /products
     *
     * DETAILS
     * The base_min_size and base_max_size fields define the min and max order size.
     * The min_market_funds and max_market_funds fields define the min and max funds allowed in a market order.
     * status_message provides any extra information regarding the status if available.
     * The quote_increment field specifies the min order price as well as the price increment.
     * The order price must be a multiple of this increment (i.e. if the increment is 0.01,
     * order prices of 0.001 or 0.021 would be rejected).
     * The base_increment field specifies the minimum increment for the base_currency.
     * trading_disabled indicates whether trading is currently restricted on this product,
     * this includes whether both new orders and order cancelations are restricted.
     *
     * cancel_only indicates whether this product only accepts cancel requests for orders.
     * post_only indicates whether only maker orders can be placed. No orders will be matched when post_only mode is active.
     * limit_only indicates whether this product only accepts limit orders.
     *
     * Only a maximum of one of trading_disabled, cancel_only, post_only, limit_only can be true at once.
     * If none are true, the product is trading normally.
     *
     * When limit_only is true, matching can occur if a limit order crosses the book.
     * Product ID will not change once assigned to a product but all other fields ares subject to change.
     *
     * @return ProductDataInterface[]
     */
    public function getProducts(): array;

    /**
     * Get Single Product
     *
     * Get market data for a specific currency pair.
     *
     * HTTP REQUEST
     * GET /products/<product-id>
     *
     * @param string $productId
     * @return ProductDataInterface
     */
    public function getSingleProduct(string $productId): ProductDataInterface;

    /**
     * Get Product Order Book
     *
     * Get a list of open orders for a product. The amount of detail shown can be customized with the level parameter.
     *
     * HTTP REQUEST
     * GET /products/<product-id>/book
     *
     * DETAILS
     * By default, only the inside (i.e. best) bid and ask are returned. This is equivalent to a book depth of 1 level.
     * If you would like to see a larger order book, specify the level query parameter.
     * If a level is not aggregated, then all of the orders at eac reth price will beurned.
     * Ah price will beggregated levels return only one size for each active price
     * (as if there was only a single order for that size at the level).
     *
     * PARAMETERS
     * Name    Default    Description
     * level    1    Select response detail. Valid levels are documented below
     *
     * Level    Description
     * 1    Only the best bid and ask
     * 2    Top 50 bids and asks (aggregated)
     * 3    Full order book (non aggregated)
     *
     * Levels 1 and 2 are aggregated. The size field is the sum of the size of the orders at that price,
     * and num-orders is the count of orders at that price; size should not be multiplied by num-orders.
     *
     * Level 3 is non-aggregated and returns the entire order book.
     * This request is NOT paginated. The entire book is returned in one response.
     *
     * Level 1 and Level 2 are recommended for polling. For the most up-to-date data, consider using the websocket stream.
     *
     * !!! !!! !!! CAREFUL !!! !!! !!!
     * !!! Level 3 is only recommended for users wishing to maintain a full real-time order book using the websocket stream.
     * !!! Abuse of Level 3 via polling will cause your access to be limited or blocked.
     * !!! !!! !!! !!!!!!! !!! !!! !!!
     *
     * @param string $productId
     * @param string $level
     * @param bool $forceLevel3
     * @return OrderBookDataInterface
     */
    public function getProductOrderBook(string $productId, string $level = self::LEVEL_ONE, bool $forceLevel3 = false): OrderBookDataInterface;

    /**
     * Get Product Ticker
     *
     * Snapshot information about the last trade (tick), best bid/ask and 24h volume.
     *
     * HTTP REQUEST
     * GET /products/<product-id>/ticker
     *
     * REAL-TIME UPDATES
     * Polling is discouraged in favor of connecting via the websocket stream and listening for match messages.
     *
     * @param string $productId
     * @return TickerSnapshotDataInterface
     */
    public function getProductTicker(string $productId): TickerSnapshotDataInterface;

    /**
     * !!! This request is paginated.
     *
     * Get Trades
     *
     * List the latest trades for a product.
     *
     * HTTP REQUEST
     * GET /products/<product-id>/trades
     *
     * SIDE
     * The trade side indicates the maker order side.
     * The maker order is the order that was open on the order book.
     * buy side indicates a down-tick because the maker was a buy order and their order was removed.
     * Conversely, sell side indicates an up-tick.
     *
     * @param string $productId
     * @param PaginationInterface $pagination
     * @return TradeDataInterface[]
     */
    public function getTrades(string $productId, ?PaginationInterface $pagination = null): array;

    /**
     * Get Historic Rates
     *
     * Historic rates for a product. Rates are returned in grouped buckets based on requested granularity.
     * Historical rate data may be incomplete. No data is published for intervals where there are no ticks.
     * Historical rates should not be polled frequently.
     * If you need real-time information, use the trade and book endpoints along with the websocket feed.
     *
     * HTTP REQUEST
     * GET /products/<product-id>/candles
     *
     * RATE LIMITS
     * This endpoint has a custom rate limit by IP: 1 request per second, up to 2 requests per second in bursts
     *
     * PARAMETERS
     * Param    Description
     * start    Start time in ISO 8601
     * end    End time in ISO 8601
     * granularity    Desired timeslice in seconds
     *
     * DETAILS
     * If either one of the start or end fields are not provided then both fields will be ignored.
     * If a custom time range is not declared then one ending now is selected.
     * The granularity field must be one of the following values: {60, 300, 900, 3600, 21600, 86400}.
     * Otherwise, your request will be rejected. These values correspond to timeslices representing one minute,
     * five minutes, fifteen minutes, one hour, six hours, and one day, respectively.
     * If data points are readily available, your response may contain as many as 300 candles and some of
     * those candles may precede your declared start value.
     * The maximum number of data points for a single request is 300 candles.
     * If your selection of start/end time and granularity will result in more than 300 data points,
     * your request will be rejected.
     * If you wish to retrieve fine granularity data over a larger time range,
     * you will need to make multiple requests with new start/end ranges.
     *
     * RESPONSE ITEMS
     * Each bucket is an array of the following information:
     * time bucket start time
     * low lowest price during the bucket interval
     * high highest price during the bucket interval
     * open opening price (first trade) in the bucket interval
     * close closing price (last trade) in the bucket interval
     * volume volume of trading activity during the bucket interval
     *
     * @param string $productId
     * @param DateTimeInterface $startTime
     * @param DateTimeInterface $endTime
     * @param string $granularity
     * @return mixed
     */
    public function getHistoricRates(
        string $productId,
        DateTimeInterface $startTime,
        DateTimeInterface $endTime,
        string $granularity
    ): HistoricRateDataInterface;

    /**
     * Get 24hr Stats
    {
      "open": "6745.61000000",
      "high": "7292.11000000",
      "low": "6650.00000000",
      "volume": "26185.51325269",
      "last": "6813.19000000",
      "volume_30day": "1019451.11188405"
    }
    Get 24 hr stats for the product. volume is in base currency units. open, high, low are in quote currency units.

    HTTP REQUEST
    GET /products/<product-id>/stats
     * @return mixed
     */
    public function get24hrStats(): Stats24hrDataInterface;
}
