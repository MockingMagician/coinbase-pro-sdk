<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

class OrderData extends AbstractCreator implements OrderDataInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var null|float
     */
    private $price;
    /**
     * @var null|float
     */
    private $size;
    /**
     * @var null|float
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
     * @var null|string
     */
    private $selfTradePrevention;
    /**
     * @var string
     */
    private $type;
    /**
     * @var null|string
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
    /**
     * @var null|string
     */
    private $profileId;
    /**
     * @var null|DateTimeInterface
     */
    private $doneAt;
    /**
     * @var null|string
     */
    private $doneReason;

    public function __construct(
        string $id,
        ?float $price,
        ?float $size,
        ?float $funds,
        string $productId,
        ?string $profileId,
        string $side,
        ?string $selfTradePrevention,
        string $type,
        ?string $timeInForce,
        bool $postOnly,
        DateTimeInterface $createdAt,
        ?DateTimeInterface $doneAt,
        ?string $doneReason,
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
        $this->profileId = $profileId;
        $this->doneAt = $doneAt;
        $this->doneReason = $doneReason;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getSide(): string
    {
        return $this->side;
    }

    public function getSelfTradePrevention(): ?string
    {
        return $this->selfTradePrevention;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTimeInForce(): ?string
    {
        return $this->timeInForce;
    }

    public function getFunds(): ?float
    {
        return $this->funds;
    }

    public function isPostOnly(): bool
    {
        return $this->postOnly;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getFillFees(): float
    {
        return $this->fillFees;
    }

    public function getFilledSize(): float
    {
        return $this->filledSize;
    }

    public function getExecutedValue(): float
    {
        return $this->executedValue;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function isSettled(): bool
    {
        return $this->settled;
    }

    public function getProfileId(): ?string
    {
        return $this->profileId;
    }

    public function getDoneAt(): ?DateTimeInterface
    {
        return $this->doneAt;
    }

    public function getDoneReason(): ?string
    {
        return $this->doneReason;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['id'],
            $array['price'] ?? null,
            $array['size'] ?? null,
            $array['funds'] ?? null,
            $array['product_id'],
            $array['profile_id'] ?? null,
            $array['side'],
            $array['stp'] ?? null,
            $array['type'],
            $array['time_in_force'] ?? null,
            $array['post_only'] ?? false,
            new DateTimeImmutable($array['created_at']),
            isset($array['done_at']) ? new DateTimeImmutable($array['done_at']) : null,
            $array['done_reason'] ?? null,
            $array['fill_fees'],
            $array['filled_size'],
            $array['executed_value'],
            $array['status'],
            $array['settled']
        );
    }

    public static function createFromJson(string $json, ...$extraData)
    {
        return self::createFromArray(Json::decode($json, true));
    }

    public static function createCollectionFromJson(string $json, ...$extraData): array
    {
        $collection = Json::decode($json, true);
        foreach ($collection as $k => $v) {
            $collection[$k] = self::createFromArray($v);
        }

        return $collection;
    }
}
