<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TickerSnapshotDataInterface;

class TickerSnapshotData extends AbstractCreator implements TickerSnapshotDataInterface
{
    /**
     * @var int
     */
    private $tradeId;
    /**
     * @var float
     */
    private $price;
    /**
     * @var float
     */
    private $size;
    /**
     * @var float
     */
    private $bid;
    /**
     * @var float
     */
    private $ask;
    /**
     * @var float
     */
    private $volume;
    /**
     * @var DateTimeInterface
     */
    private $time;

    public function __construct(
        int $tradeId,
        float $price,
        float $size,
        float $bid,
        float $ask,
        float $volume,
        DateTimeInterface $time
    ) {
        $this->tradeId = $tradeId;
        $this->price = $price;
        $this->size = $size;
        $this->bid = $bid;
        $this->ask = $ask;
        $this->volume = $volume;
        $this->time = $time;
    }

    public function getTradeId(): int
    {
        return $this->tradeId;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function getBid(): float
    {
        return $this->bid;
    }

    public function getAsk(): float
    {
        return $this->ask;
    }

    public function getVolume(): float
    {
        return $this->volume;
    }

    public function getTime(): DateTimeInterface
    {
        return $this->time;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        return new static(
            $array['trade_id'],
            $array['price'],
            $array['size'],
            $array['bid'],
            $array['ask'],
            $array['volume'],
            new DateTimeImmutable($array['time'])
        );
    }
}
