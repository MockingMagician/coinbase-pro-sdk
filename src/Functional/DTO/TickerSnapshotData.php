<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TickerSnapshotDataInterface;

class TickerSnapshotData implements TickerSnapshotDataInterface
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

    /**
     * @return int
     */
    public function getTradeId(): int
    {
        return $this->tradeId;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getSize(): float
    {
        return $this->size;
    }

    /**
     * @return float
     */
    public function getBid(): float
    {
        return $this->bid;
    }

    /**
     * @return float
     */
    public function getAsk(): float
    {
        return $this->ask;
    }

    /**
     * @return float
     */
    public function getVolume(): float
    {
        return $this->volume;
    }

    /**
     * @return DateTimeInterface
     */
    public function getTime(): DateTimeInterface
    {
        return $this->time;
    }

    public static function createFromArray(array $array)
    {
        return new self(
            $array['trade_id'],
            $array['price'],
            $array['size'],
            $array['bid'],
            $array['ask'],
            $array['volume'],
            new DateTimeImmutable($array['time'])
        );
    }

    public static function createFromJson(string $json)
    {
        return self::createFromArray(json_decode($json, true));
    }
}
