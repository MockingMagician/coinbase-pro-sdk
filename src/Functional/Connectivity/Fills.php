<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\FillsInterface;

class Fills extends AbstractRequestManagerAware implements FillsInterface
{
    // TODO implementer later when order and product are availables
    public function listFillsRaw(?string $orderId = null, ?string $productId = null, PaginationInterface $pagination = null)
    {
        $query = [];

        if ($orderId) {
            $query['order_id'] = $orderId;
        }
        if ($productId) {
            $query['product_id'] = $productId;
        }

        return $this->getRequestManager()->prepareRequest('GET', '/fills', $query, null, $pagination)->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function listFills(?string $orderId = null, ?string $productId = null, PaginationInterface $pagination = null): array
    {
    }
}
