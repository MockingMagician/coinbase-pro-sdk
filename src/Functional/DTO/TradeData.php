<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TradeDataInterface;

class TradeData implements TradeDataInterface
{
    /**
     * @var DateTimeInterface
     */
    private $time;
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
     * @var string
     */
    private $side;

    public function __construct(
        DateTimeInterface $time,
        int $tradeId,
        float $price,
        float $size,
        string $side
    ) {
        $this->time = $time;
        $this->tradeId = $tradeId;
        $this->price = $price;
        $this->size = $size;
        $this->side = $side;
    }

    /**
     * @return DateTimeInterface
     */
    public function getTime(): DateTimeInterface
    {
        return $this->time;
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
     * @return string
     */
    public function getSide(): string
    {
        return $this->side;
    }

    public static function createFromArray(array $array)
    {
        return new self(
            new DateTimeImmutable($array['time']),
            $array['trade_id'],
            $array['price'],
            $array['size'],
            $array['side']
        );
    }

    public static function createCollectionFromJson(string $json)
    {
        $collection = json_decode($json, true);
        foreach ($collection as $k => $v) {
            $collection[$k] = self::createFromArray($v);
        }

        return $collection;
    }
}
