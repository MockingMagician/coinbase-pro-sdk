<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\FillDataInterface;

class FillData implements FillDataInterface
{
    /**
     * @var int
     */
    private $tradeId;
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
    private $size;
    /**
     * @var string
     */
    private $orderId;
    /**
     * @var DateTimeInterface
     */
    private $createdAt;
    /**
     * @var string
     */
    private $liquidity;
    /**
     * @var float
     */
    private $fee;
    /**
     * @var bool
     */
    private $settled;
    /**
     * @var string
     */
    private $side;

    public function __construct(
        int $tradeId,
        string $productId,
        float $price,
        float $size,
        string $orderId,
        DateTimeInterface $createdAt,
        string $liquidity,
        float $fee,
        bool $settled,
        string $side
    ) {
        $this->tradeId = $tradeId;
        $this->productId = $productId;
        $this->price = $price;
        $this->size = $size;
        $this->orderId = $orderId;
        $this->createdAt = $createdAt;
        $this->liquidity = $liquidity;
        $this->fee = $fee;
        $this->settled = $settled;
        $this->side = $side;
    }

    /**
     * @return int
     */
    public function getTradeId(): int
    {
        return $this->tradeId;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
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
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getLiquidity(): string
    {
        return $this->liquidity;
    }

    /**
     * @return float
     */
    public function getFee(): float
    {
        return $this->fee;
    }

    /**
     * @return bool
     */
    public function isSettled(): bool
    {
        return $this->settled;
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
            $array['trade_id'],
            $array['product_id'],
            $array['price'],
            $array['size'],
            $array['order_id'],
            new DateTimeImmutable($array['created_at']),
            $array['liquidity'],
            $array['fee'],
            $array['settled'],
            $array['side']
        );
    }

    public static function createCollectionFromJson(string $json)
    {
        $collection = json_decode($json, true);
        foreach ($collection as $k => &$value) {
            $collection[$k] = self::createFromArray($value);
        }

        return $collection;
    }
}
