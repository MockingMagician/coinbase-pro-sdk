<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Build\CommonOrderToPlaceInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\OrdersInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderData;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

class Orders extends AbstractConnectivity implements OrdersInterface
{
    public function placeOrderRaw(CommonOrderToPlaceInterface $orderToPlace): string
    {
        return $this->getRequestFactory()->createRequest('POST', '/orders', [], Json::encode($orderToPlace->getBodyForRequest()))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function placeOrder(CommonOrderToPlaceInterface $orderToPlace): OrderDataInterface
    {
        return OrderData::createFromJson($this->placeOrderRaw($orderToPlace));
    }

    public function cancelOrderByIdRaw(string $orderId, string $productId = null): string
    {
        $body = null;

        if ($productId) {
            $body = ['product_id' => $productId];
        }

        return $this->getRequestFactory()
            ->createRequest('DELETE', sprintf('/orders/%s', $orderId), [], $body ? Json::encode($body) : null)
            ->send()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function cancelOrderById(string $orderId, string $productId = null): bool
    {
        return $orderId === json_decode($this->cancelOrderByIdRaw($orderId, $productId), true);
    }

    public function cancelOrderByClientOrderIdRaw(string $clientOrderId, string $productId = null): string
    {
        $body = null;

        if ($productId) {
            $body = ['product_id' => $productId];
        }

        return $this->getRequestFactory()
            ->createRequest('DELETE', sprintf('/orders/client:%s', $clientOrderId), [], $body ? Json::encode($body) : null)
            ->send()
        ;
    }

    public function cancelOrderByClientOrderId(string $clientOrderId, string $productId = null): bool
    {
        $this->cancelOrderByClientOrderIdRaw($clientOrderId, $productId);

        return true; // assume error was not throw equals true
    }

    public function cancelAllOrdersRaw(string $productId = null): string
    {
        $body = null;

        if ($productId) {
            $body = ['product_id' => $productId];
        }

        return $this->getRequestFactory()
            ->createRequest('DELETE', '/orders', [], $body ? Json::encode($body) : null)
            ->send()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function cancelAllOrders(string $productId = null): array
    {
        $ids = json_decode($this->cancelAllOrdersRaw($productId), true);

        if (is_array($ids)) {
            return $ids;
        }

        return [];
    }

    public function listOrdersRaw(array $status = self::STATUS, string $productId = null, PaginationInterface $pagination = null): string
    {
        $query = [];

        $query['status'] = $status;

        if ($productId) {
            $query = ['product_id' => $productId];
        }

        return $this->getRequestFactory()->createRequest('GET', '/orders', $query, null, $pagination)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function listOrders(array $status = self::STATUS, string $productId = null, PaginationInterface $pagination = null): array
    {
        return OrderData::createCollectionFromJson($this->listOrdersRaw($status, $productId, $pagination));
    }

    public function getOrderByIdRaw(string $orderId): string
    {
        return $this->getRequestFactory()->createRequest('GET', sprintf('/orders/%s', $orderId))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderById(string $orderId): OrderDataInterface
    {
        return OrderData::createFromJson($this->getOrderByIdRaw($orderId));
    }

    public function getOrderByClientOrderIdRaw(string $clientOrderId): string
    {
        return $this->getRequestFactory()->createRequest('GET', sprintf('/orders/client:%s', $clientOrderId))->send();
    }

    public function getOrderByClientOrderId(string $clientOrderId): OrderDataInterface
    {
        return OrderData::createFromJson($this->getOrderByClientOrderIdRaw($clientOrderId));
    }
}
