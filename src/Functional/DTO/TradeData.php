<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

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

    public function getTime(): DateTimeInterface
    {
        return $this->time;
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
