<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ProductsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\HistoricRateDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderBookDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProductDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TickerSnapshotDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\Stats24hrDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TradeDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\LimitsData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderBookData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ProductData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TickerSnapshotData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TradeData;

class Products extends AbstractRequestManagerAware implements ProductsInterface
{
    public function getProductsRaw()
    {
        return $this->getRequestManager()->prepareRequest('GET', '/products')->send();
    }

    /**
     * @inheritDoc
     */
    public function getProducts(): array
    {
        return ProductData::createCollectionFromJson($this->getProductsRaw());
    }

    public function getSingleProductRaw(string $productId)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/products/%s', $productId))->send();
    }

    /**
     * @inheritDoc
     */
    public function getSingleProduct(string $productId): ProductDataInterface
    {
        return ProductData::createFromJson($this->getSingleProductRaw($productId));
    }

    public function getProductOrderBookRaw(string $productId, string $level = self::LEVEL_ONE, bool $forceLevel3 = false)
    {
        $query = ['level' => 1];
        if ($level === 2) {
            $query['level'] = 2;
        }
        if ($level === 3 && $forceLevel3) {
            $query['level'] = 3;
        }

        return $this->getRequestManager()->prepareRequest('GET', sprintf('/products/%s/book', $productId))->send();
    }

    /**
     * @inheritDoc
     */
    public function getProductOrderBook(string $productId, string $level = self::LEVEL_ONE, bool $forceLevel3 = false): OrderBookDataInterface
    {
        return OrderBookData::createFromJson($this->getProductOrderBookRaw($productId, $level, $forceLevel3));
    }

    public function getProductTickerRaw(string $productId)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/products/%s/ticker', $productId))->send();
    }

    /**
     * @inheritDoc
     */
    public function getProductTicker(string $productId): TickerSnapshotDataInterface
    {
        return TickerSnapshotData::createFromJson($this->getProductTickerRaw($productId));
    }

    public function getTradesRaw(string $productId, ?PaginationInterface $pagination = null)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/products/%s/trades', $productId), [], null, $pagination)->send();
    }

    /**
     * @inheritDoc
     */
    public function getTrades(string $productId, ?PaginationInterface $pagination = null): array
    {
        return TradeData::createCollectionFromJson($this->getTradesRaw($productId, $pagination));
    }

    /**
     * @inheritDoc
     */
    public function getHistoricRates(string $productId, DateTimeInterface $startTime, DateTimeInterface $endTime, string $granularity): HistoricRateDataInterface
    {
        // TODO: Implement getHistoricRates() method.
    }

    /**
     * @inheritDoc
     */
    public function get24hrStats(): Stats24hrDataInterface
    {
        // TODO: Implement get24hrStats() method.
    }
}
