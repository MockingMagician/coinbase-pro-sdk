<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\FillsInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\FillData;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class Fills extends AbstractConnectivity implements FillsInterface
{
    /**
     * @throws ApiError
     */
    public function listFillsRaw(?string $orderId = null, ?string $productId = null, ?PaginationInterface $pagination = null): string
    {
        $query = [];

        if ($orderId) {
            $query['order_id'] = $orderId;
        }
        if ($productId) {
            $query['product_id'] = $productId;
        }

        if (!isset($orderId, $productId)) {
            throw new ApiError('Either $orderId or $productId MUST be specified');
        }

        return $this->getRequestFactory()->createRequest('GET', '/fills', $query, null, $pagination)->send();
    }

    /**
     * {@inheritdoc}
     * @throws ApiError
     */
    public function listFills(?string $orderId = null, ?string $productId = null, ?PaginationInterface $pagination = null): array
    {
        return FillData::createCollectionFromJson($this->listFillsRaw($orderId, $productId, $pagination));
    }
}
