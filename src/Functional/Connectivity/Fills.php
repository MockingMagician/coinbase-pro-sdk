<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\FillsInterface;

class Fills extends AbstractRequestManagerAware implements FillsInterface
{
    public function listFillsRaw(?string $orderId = null, ?string $productId = null, PaginationInterface $pagination = null): array
    {

    }

    /**
     * @inheritDoc
     */
    public function listFills(?string $orderId = null, ?string $productId = null, PaginationInterface $pagination = null): array
    {
        $orderId
    }
}
