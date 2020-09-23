<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use DateTime;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ProductsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\HistoricRatesDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderBookDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProductDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProductStats24hrDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TickerSnapshotDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\HistoricRatesData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderBookData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ProductData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ProductStats24hrData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TickerSnapshotData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TradeData;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class Products extends AbstractRequestManagerAware implements ProductsInterface
{
    /**
     * @var null|float
     */
    private static $lastCallToHistoricRates = null;

    public function getProductsRaw()
    {
        return $this
            ->getRequestManager()
            ->prepareRequest('GET', '/products')
            ->setMustBeSigned(false)
            ->send()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getProducts(): array
    {
        return ProductData::createCollectionFromJson($this->getProductsRaw());
    }

    public function getSingleProductRaw(string $productId)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/products/%s', $productId))->setMustBeSigned(false)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getSingleProduct(string $productId): ProductDataInterface
    {
        return ProductData::createFromJson($this->getSingleProductRaw($productId));
    }

    public function getProductOrderBookRaw(string $productId, int $level = self::LEVEL_ONE, bool $forceLevel3 = false)
    {
        $query = ['level' => 1];
        if (2 === $level) {
            $query['level'] = 2;
        }
        if (3 === $level && $forceLevel3) {
            $query['level'] = 3;
        }

        return $this->getRequestManager()->prepareRequest('GET', sprintf('/products/%s/book', $productId))->setMustBeSigned(false)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getProductOrderBook(string $productId, int $level = self::LEVEL_ONE, bool $forceLevel3 = false): OrderBookDataInterface
    {
        return OrderBookData::createFromJson($this->getProductOrderBookRaw($productId, $level, $forceLevel3));
    }

    public function getProductTickerRaw(string $productId)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/products/%s/ticker', $productId))->setMustBeSigned(false)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getProductTicker(string $productId): TickerSnapshotDataInterface
    {
        return TickerSnapshotData::createFromJson($this->getProductTickerRaw($productId));
    }

    public function getTradesRaw(string $productId, ?PaginationInterface $pagination = null)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/products/%s/trades', $productId), [], null, $pagination)->setMustBeSigned(false)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getTrades(string $productId, ?PaginationInterface $pagination = null): array
    {
        return TradeData::createCollectionFromJson($this->getTradesRaw($productId, $pagination));
    }

    public function getHistoricRatesRaw(string $productId, DateTimeInterface $startTime, DateTimeInterface $endTime, int $granularity)
    {
        $this->checkHistoricRatesParams($startTime, $endTime, $granularity);

        $query = [
            'start' => $startTime->format(DateTime::ISO8601),
            'end' => $endTime->format(DateTime::ISO8601),
            'granularity' => $granularity,
        ];

        $this->blockRequestWhileExceedRates();

        $raw = $this->getRequestManager()->prepareRequest('GET', sprintf('/products/%s/candles', $productId), $query)->setMustBeSigned(false)->send();

        self::$lastCallToHistoricRates = microtime(true);

        return $raw;
    }

    /**
     * {@inheritdoc}
     */
    public function getHistoricRates(string $productId, DateTimeInterface $startTime, DateTimeInterface $endTime, int $granularity): HistoricRatesDataInterface
    {
        return HistoricRatesData::createFromJson($this->getHistoricRatesRaw($productId, $startTime, $endTime, $granularity), $granularity);
    }

    public function get24hrStatsRaw(string $productId)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/products/%s/stats', $productId))->setMustBeSigned(false)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function get24hrStats(string $productId): ProductStats24hrDataInterface
    {
        return ProductStats24hrData::createFromJson($this->get24hrStatsRaw($productId));
    }

    private function checkHistoricRatesParams(DateTimeInterface $startTime, DateTimeInterface $endTime, int $granularity)
    {
        if (!in_array($granularity, self::GRANULARITY)) {
            throw new ApiError(sprintf(
                'Granularity must be one of : %s. See %s docBlock for more information about.',
                implode(', ', self::GRANULARITY),
                ProductsInterface::class
            ));
        }

        if ($endTime->getTimestamp() - $startTime->getTimestamp() < 1) {
            throw new ApiError('StartTime must be before EndTime');
        }

        if (
            ($expectedCandles = ($endTime->getTimestamp() - $startTime->getTimestamp()) / $granularity)
            > self::MAX_CANDLES
        ) {
            throw new ApiError(sprintf(
                'This exception happen cause you request a too large set of data. %s candles max is allowed. Please, change one of this value of granularity, startTime, endTime. Current values request an expected set of %s of candles',
                self::MAX_CANDLES,
                $expectedCandles
            ));
        }
    }

    private function blockRequestWhileExceedRates()
    {
        if (!is_null(self::$lastCallToHistoricRates)) {
            while ((microtime(true) - self::$lastCallToHistoricRates) < (self::RATE_LIMIT_HISTORIC_RATES * self::RATE_LIMIT_HISTORIC_ARBITRARY_RATIO)) {
                continue;
            }
        }
    }
}
