<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\FillDataInterface;

interface FillsInterface
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
}
