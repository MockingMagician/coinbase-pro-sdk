<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderDataInterface;

class OrderData implements OrderDataInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var float|null
     */
    private $price;
    /**
     * @var float|null
     */
    private $size;
    /**
     * @var float|null
     */
    private $funds;
    /**
     * @var string
     */
    private $productId;
    /**
     * @var string
     */
    private $side;
    /**
     * @var string
     */
    private $selfTradePrevention;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string|null
     */
    private $timeInForce;
    /**
     * @var bool
     */
    private $postOnly;
    /**
     * @var DateTimeInterface
     */
    private $createdAt;
    /**
     * @var float
     */
    private $fillFees;
    /**
     * @var float
     */
    private $filledSize;
    /**
     * @var float
     */
    private $executedValue;
    /**
     * @var string
     */
    private $status;
    /**
     * @var bool
     */
    private $settled;

    public function __construct(
        string $id,
        ?float $price,
        ?float $size,
        ?float $funds,
        string $productId,
        string $side,
        string $selfTradePrevention,
        string $type,
        ?string $timeInForce,
        bool $postOnly,
        DateTimeInterface $createdAt,
        float $fillFees,
        float $filledSize,
        float $executedValue,
        string $status,
        bool $settled
    ) {
        $this->id = $id;
        $this->price = $price;
        $this->size = $size;
        $this->funds = $funds;
        $this->productId = $productId;
        $this->side = $side;
        $this->selfTradePrevention = $selfTradePrevention;
        $this->type = $type;
        $this->timeInForce = $timeInForce;
        $this->postOnly = $postOnly;
        $this->createdAt = $createdAt;
        $this->fillFees = $fillFees;
        $this->filledSize = $filledSize;
        $this->executedValue = $executedValue;
        $this->status = $status;
        $this->settled = $settled;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
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
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getSide(): string
    {
        return $this->side;
    }

    /**
     * @return string
     */
    public function getSelfTradePrevention(): string
    {
        return $this->selfTradePrevention;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getTimeInForce(): ?string
    {
        return $this->timeInForce;
    }

    /**
     * @return float
     */
    public function getFunds(): ?float
    {
        return $this->funds;
    }

    /**
     * @return bool
     */
    public function isPostOnly(): bool
    {
        return $this->postOnly;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return float
     */
    public function getFillFees(): float
    {
        return $this->fillFees;
    }

    /**
     * @return float
     */
    public function getFilledSize(): float
    {
        return $this->filledSize;
    }

    /**
     * @return float
     */
    public function getExecutedValue(): float
    {
        return $this->executedValue;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isSettled(): bool
    {
        return $this->settled;
    }

    public static function createFromArray(array $array)
    {
        return new self(
            $array['id'],
            $array['price'] ?? null,
            $array['size'] ?? null,
            $array['funds'] ?? null,
            $array['product_id'],
            $array['side'],
            $array['stp'],
            $array['type'],
            $array['time_in_force'] ?? null,
            $array['post_only'],
            new DateTimeImmutable($array['created_at']),
            $array['fill_fees'],
            $array['filled_size'],
            $array['executed_value'],
            $array['status'],
            $array['settled']
        );
    }

    public static function createFromJson(string $json)
    {
        return self::createFromArray(json_decode($json, true));
    }
}
