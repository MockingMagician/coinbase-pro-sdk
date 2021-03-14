<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

use DateTimeImmutable;

class TickerMessage extends AbstractMessage
{
    /**
     * @var int
     */
    private $sequence;
    /**
     * @var float
     */
    private $open24h;
    /**
     * @var string
     */
    private $productId;
    /**
     * @var float
     */
    private $price;
    /**
     * @var float
     */
    private $volume24h;
    /**
     * @var float
     */
    private $low24h;
    /**
     * @var float
     */
    private $high24h;
    /**
     * @var float
     */
    private $volume30d;
    /**
     * @var float
     */
    private $bestBid;
    /**
     * @var float
     */
    private $bestAsk;
    /**
     * @var string
     */
    private $side;
    /**
     * @var DateTimeImmutable
     */
    private $time;
    /**
     * @var int
     */
    private $tradeId;
    /**
     * @var float
     */
    private $lastSize;

    public function __construct(array $payload)
    {
        parent::__construct($payload);

        $this->sequence = (int) $payload['sequence'];
        $this->productId = $payload['product_id'];
        $this->price = (float) $payload['price'];
        $this->open24h = (float) $payload['open_24h'];
        $this->volume24h = (float) $payload['volume_24h'];
        $this->low24h = (float) $payload['low_24h'];
        $this->high24h = (float) $payload['high_24h'];
        $this->volume30d = (float) $payload['volume_30d'];
        $this->bestBid = (float) $payload['best_bid'];
        $this->bestAsk = (float) $payload['best_ask'];
        $this->side = $payload['side'];
        $this->time = new DateTimeImmutable($payload['time']);
        $this->tradeId = (int) $payload['trade_id'];
        $this->lastSize = (float) $payload['last_size'];
    }

    public function getSequence(): int
    {
        return $this->sequence;
    }

    public function getOpen24h(): float
    {
        return $this->open24h;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getVolume24h(): float
    {
        return $this->volume24h;
    }

    public function getLow24h(): float
    {
        return $this->low24h;
    }

    public function getHigh24h(): float
    {
        return $this->high24h;
    }

    public function getVolume30d(): float
    {
        return $this->volume30d;
    }

    public function getBestBid(): float
    {
        return $this->bestBid;
    }

    public function getBestAsk(): float
    {
        return $this->bestAsk;
    }

    public function getSide(): string
    {
        return $this->side;
    }

    public function getTime(): DateTimeImmutable
    {
        return $this->time;
    }

    public function getTradeId(): int
    {
        return $this->tradeId;
    }

    public function getLastSize(): float
    {
        return $this->lastSize;
    }
}
