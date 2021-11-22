<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\OrderInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\FillDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Error\ApiErrorInterface;
use MockingMagician\CoinbaseProSdk\Functional\Enum\OrderSortedBy;
use MockingMagician\CoinbaseProSdk\Functional\Enum\OrderStatus;
use MockingMagician\CoinbaseProSdk\Functional\Enum\SortDirection;

interface OrdersInterface
{
    /**
     * Get a list of fills. A fill is a partial or complete match on a specific order.
     *
     * Request : GET /fills
     *
     * API Key Permissions
     * This endpoint requires either the "view" or "trade" permission.
     *
     * Settlement and Fees
     * Fees are recorded in two stages. Immediately after the matching engine completes a match, the fill is inserted into our datastore.
     * Once the fill is recorded, a settlement process will settle the fill and credit both trading counterparties.
     *
     * The fee field indicates the fees charged for this individual fill.
     *
     * Liquidity
     * The liquidity field indicates if the fill was the result of a liquidity provider or liquidity taker.
     * M indicates Maker and T indicates Taker.
     *
     * @return FillDataInterface[]
     */
    public function listFills(?string $orderId = null, ?string $productId = null, ?PaginationInterface $pagination = null): array;

    /**
     * List your current open orders. Only open or un-settled orders are returned by default.
     * As soon as an order is no longer open and settled, it will no longer appear in the default request.
     * Open orders may change state between the request and the response depending on market conditions.
     *
     * Request : GET /orders
     *
     * API Key Permissions
     * This endpoint requires either the "view" or "trade" permission.
     *
     * Note that orders with a "pending" status have a reduced set of fields in the response.
     *
     * "pending" Limit orders will not have stp, time_in_force, expire_time, and post_only.
     * "pending" Market orders will have the same fields as a "pending" Limit order minus price and size, and no Market specific fields (funds, specified_funds).
     * "pending" Stop orders will have the same fields as a "pending" Limit order and no Stop specific fields (stop, stop_price).
     *
     * Order status and settlement
     * Orders which are no longer resting on the order book, will be marked with the done status.
     * There is a small window between an order being done and settled.
     * An order is settled when all of the fills have settled and the remaining holds (if any) have been removed.
     *
     * Polling
     * For high-volume trading it is strongly recommended that you maintain your own list of open orders and use one of the streaming market data feeds to keep it updated.
     * You should poll the open orders endpoint once when you start trading to obtain the current state of any open orders.
     *
     * executed_value is the cumulative match size * price and is only present for orders placed after 2016-05-20.
     *
     * Open orders may change state between the request and the response depending on market conditions.
     *
     * @return OrderDataInterface[]
     */
    public function listOrders(
        OrderStatus $status,
        string $productId = null,
        PaginationInterface $pagination = null,
        OrderSortedBy $sortedBy = null,
        SortDirection $sortedByDirection = null,
        ?DateTimeInterface $startDate = null,
        ?DateTimeInterface $endDate = null
    ): array;

    /**
     * With best effort, cancel all open orders.
     * This may require you to make the request multiple times until all of the open orders are deleted.
     *
     * Request : DELETE /orders
     *
     * API Key Permissions
     * This endpoint requires the "trade" permission.
     */
    public function cancelAllOrders(string $productId = null): array;

    /**
     * Create an order. You can place two types of orders: limit and market.
     * Orders can only be placed if your account has sufficient funds.
     * Once an order is placed, your account funds will be put on hold for the duration of the order.
     * How much and which funds are put on hold depends on the order type and parameters specified.
     *
     * Request : POST /orders
     *
     * API Key Permissions
     * This endpoint requires the "trade" permission.
     *
     * limit order parameters
     * Param	Description
     * price	Price per bitcoin
     * size	Amount of BTC to buy or sell
     * time_in_force	[optional] GTC, GTT, IOC, or FOK (default is GTC)
     * cancel_after	[optional] min, hour, day => Requires time_in_force to be GTT
     * post_only	[optional] Post only flag => Invalid when time_in_force is IOC or FOK
     *
     * @throws ApiErrorInterface
     */
    public function placeOrder(OrderInterface $orderToPlace): OrderDataInterface;

    /**
     * Cancel an Order
     * Cancel a previously placed order. Order must belong to the profile that the API key belongs to.
     *
     * If the order had no matches during its lifetime its record may be purged.
     * This means the order details will not be available with GET /orders/<id>.
     *
     * HTTP REQUEST
     * DELETE /orders/<id>
     * DELETE /orders/client:<client_oid>
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "trade" permission.
     *
     * Orders may be canceled using either the exchange assigned id or the client assigned client_oid.
     * When using client_oid it must be preceded by the client: namespace.
     *
     * QUERY PARAMETERS
     * Param    Default    Description
     * product_id    [optional]    The product ID of the order.
     * While not required, the request will be more performant if you include it.
     *
     * CANCEL REJECT
     * If the order could not be canceled (already filled or previously canceled, etc),
     * then an error response will indicate the reason in the message field.
     */
    public function cancelOrderById(string $orderId, string $productId = null): bool;

    public function cancelOrderByClientOrderId(string $clientOrderId, string $productId = null): bool;

    /**
     * Get an Order
     * Get a single order by order id from the profile that the API key belongs to.
     *
     * HTTP REQUEST
     * GET /orders/<id>
     * GET /orders/client:<client_oid>
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * Orders may be queried using either the exchange assigned id or the client assigned client_oid.
     * When using client_oid it must be preceded by the client: namespace.
     *
     * If the order is canceled the response may have status code 404 if the order had no matches.
     *
     * Open orders may change state between the request and the response depending on market conditions.
     */
    public function getOrderById(string $orderId): OrderDataInterface;

    public function getOrderByClientOrderId(string $clientOrderId): OrderDataInterface;
}
