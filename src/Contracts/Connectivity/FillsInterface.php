<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\FillDataInterface;

interface FillsInterface
{
    /**
     * !!! This request is paginated.
     *
     * List Fills
     * Get a list of recent fills of the API key's profile.
     *
     * HTTP REQUEST
     * GET /fills
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * QUERY PARAMETERS
     * You can request fills for specific orders or products using query parameters.
     *
     * Param    Default    Description
     * order_id    all    Limit list of fills to this order_id
     * product_id    all    Limit list of fills to this product_id
     * You are required to provide either a product_id or order_id.
     *
     * SETTLEMENT AND FEES
     * Fees are recorded in two stages.
     * Immediately after the matching engine completes a match, the fill is inserted into our datastore.
     * Once the fill is recorded, a settlement process will settle the fill and credit both trading counterparties.
     *
     * The fee field indicates the fees charged for this individual fill.
     *
     * LIQUIDITY
     * The liquidity field indicates if the fill was the result of a liquidity provider or liquidity taker. M indicates Maker and T indicates Taker.
     *
     * PAGINATION
     * Fills are returned sorted by descending trade_id from the largest trade_id to the smallest trade_id. The CB-BEFORE header will have this first trade id so that future requests using the cb-before parameter will fetch fills with a greater trade id (newer fills).
     *
     * @param string|null $orderId
     * @param string|null $productId
     * @param PaginationInterface|null $pagination
     * @return FillDataInterface[]
     */
    public function listFills(?string $orderId = null, ?string $productId = null, PaginationInterface $pagination = null): array;
}
