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

        return $this->getRequestManager()
            ->prepareRequest('DELETE', sprintf('/orders/%s', $orderId), [], $body ? json_encode($body) : null)
            ->signAndSend()
        ;
    }

    /**
     * @inheritDoc
     */
    public function cancelOrderById(string $orderId, string $productId = null): bool
    {
        return $orderId === json_decode($this->cancelOrderByIdRaw($orderId, $productId), true);
    }

    public function cancelOrderByClientOrderIdRaw(string $clientOrderId, string $productId = null)
    {
        $body = null;

        if ($productId) {
            $body = ['product_id' => $productId];
        }

        return $this->getRequestManager()
            ->prepareRequest('DELETE', sprintf('/orders/client:%s', $clientOrderId), [], $body ? json_encode($body) : null)
            ->signAndSend()
        ;
    }

    public function cancelOrderByClientOrderId(string $clientOrderId, string $productId = null): bool
    {
        $this->cancelOrderByClientOrderIdRaw($clientOrderId, $productId);

        return true; // assume error was not throw equals true
    }

    public function cancelAllOrdersRaw(string $productId = null)
    {
        $body = null;

        if ($productId) {
            $body = ['product_id' => $productId];
        }

        return $this->getRequestManager()
            ->prepareRequest('DELETE', '/orders', [], $body ? json_encode($body) : null)
            ->signAndSend()
        ;
    }

    /**
     * @inheritDoc
     */
    public function cancelAllOrders(string $productId = null): array
    {
        $ids = json_decode($this->cancelAllOrdersRaw($productId), true);

        if (is_array($ids)) {
            return $ids;
        }

        return [];
    }

    public function listOrdersRaw(array $status = self::STATUS, string $productId = null, PaginationInterface $pagination = null)
    {
        $query = [];

        $query['status'] = $status;

        if ($productId) {
            $query = ['product_id' => $productId];
        }

        return $this->getRequestManager()->prepareRequest('GET', '/orders', $query, null, $pagination)->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function listOrders(array $status = self::STATUS, string $productId = null, PaginationInterface $pagination = null): array
    {
        return OrderData::createCollectionFromJson($this->listOrdersRaw($status, $productId, $pagination));
    }

    public function getOrderByIdRaw(string $orderId)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/orders/%s', $orderId))->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function getOrderById(string $orderId): OrderDataInterface
    {
        return OrderData::createFromJson($this->getOrderByIdRaw($orderId));
    }

    public function getOrderByClientOrderIdRaw(string $clientOrderId)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/orders/client:%s', $clientOrderId))->signAndSend();
    }

    public function getOrderByClientOrderId(string $clientOrderId): OrderDataInterface
    {
        // TODO: Implement getOrderByClientOrderId() method.
    }
}
