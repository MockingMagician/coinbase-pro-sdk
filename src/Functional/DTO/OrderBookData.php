<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderBookDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderBookDetailsDataInterface;

class OrderBookData implements OrderBookDataInterface
{
    /**
     * @var int
     */
    private $sequence;
    /**
     * @var array
     */
    private $bids;
    /**
     * @var array
     */
    private $asks;

    public function __construct(
        int $sequence,
        array $bids,
        array $asks
    ) {
        $this->sequence = $sequence;
        $this->bids = $bids;
        $this->asks = $asks;
    }

    /**
     * @return int
     */
    public function getSequence(): int
    {
        return $this->sequence;
    }

    /**
     * @return array
     */
    public function getBids(): array
    {
        return $this->bids;
    }

    /**
     * @return array
     */
    public function getAsks(): array
    {
        return $this->asks;
    }

    public static function createFromArray(array $array) {
        $bids = [];
        foreach ($array['bids'] as $k => $v) {
            $array['bids'][$k] = OrderBookDetailsData::createFromArray($v);
        }
        foreach ($array['asks'] as $k => $v) {
            $array['asks'][$k] = OrderBookDetailsData::createFromArray($v);
        }
        return new self($array['sequence'], $array['bids'], $array['asks']);
    }

    public static function createFromJson(string $json) {
        return self::createFromArray(json_decode($json, true));
    }

}
