<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Build\CommonOrderToPlaceInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\OrdersInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderData;

class Orders extends AbstractRequestManagerAware implements OrdersInterface
{
    public function placeOrderRaw(CommonOrderToPlaceInterface $orderToPlace)
    {
        return $this->getRequestManager()->prepareRequest('POST', '/orders', [], json_encode($orderToPlace->getBodyForRequest()))->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function placeOrder(CommonOrderToPlaceInterface $orderToPlace): OrderDataInterface
    {
        return OrderData::createFromJson($this->placeOrderRaw($orderToPlace));
    }

    public function cancelOrderByIdRaw(string $orderId, string $productId = null)
    {
        $body = null;

        if ($productId) {
            $body = ['product_id' => $productId];
        }

        return $this->getRequestManager()->prepareRequest('DELETE', sprintf('/orders/%s', $orderId), [], json_encode($body))->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function cancelOrderById(string $orderId, string $productId = null): bool
    {
    }

    public function cancelOrderByClientOrderId(string $clientOrderId, string $productId = null): bool
    {
        // TODO: Implement cancelOrderByClientOrderId() method.
    }

    /**
     * @inheritDoc
     */
    public function cancelAllOrders(CommonOrderToPlaceInterface $orderToPlace, string $productId = null): array
    {
        // TODO: Implement cancelAllOrders() method.
    }

    /**
     * @inheritDoc
     */
    public function listOrders(array $status = self::STATUS, string $productId = null, PaginationInterface $pagination = null): array
    {
        // TODO: Implement listOrders() method.
    }

    /**
     * @inheritDoc
     */
    public function getOrderById(string $orderId): OrderDataInterface
    {
        // TODO: Implement getOrderById() method.
    }

    public function getOrderByClientOrderId(string $clientOrderId): OrderDataInterface
    {
        // TODO: Implement getOrderByClientOrderId() method.
    }
}
