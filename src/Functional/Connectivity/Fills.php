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

class Fills extends AbstractRequestFactoryAware implements FillsInterface
{
    public function listFillsRaw(?string $orderId = null, ?string $productId = null, ?PaginationInterface $pagination = null): string
    {
        $query = [];

        if ($orderId) {
            $query['order_id'] = $orderId;
        }
        if ($productId) {
            $query['product_id'] = $productId;
        }

        return $this->getRequestFactory()->createRequest('GET', '/fills', $query, null, $pagination)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function listFills(?string $orderId = null, ?string $productId = null, ?PaginationInterface $pagination = null): array
    {
        return FillData::createCollectionFromJson($this->listFillsRaw($orderId, $productId, $pagination));
    }
}
