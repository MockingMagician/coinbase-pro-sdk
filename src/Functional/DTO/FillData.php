<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\FillDataInterface;

class FillData extends AbstractCreator implements FillDataInterface
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
    /**
     * @var string|null
     */
    private $userId;
    /**
     * @var string|null
     */
    private $profileId;
    /**
     * @var float|null
     */
    private $usdVolume;

    public function __construct(
        int $tradeId,
        string $productId,
        float $price,
        float $size,
        string $orderId,
        ?string $userId,
        ?string $profileId,
        DateTimeInterface $createdAt,
        string $liquidity,
        float $fee,
        bool $settled,
        ?float $usdVolume,
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
        $this->userId = $userId;
        $this->profileId = $profileId;
        $this->usdVolume = $usdVolume;
    }

    public function getTradeId(): int
    {
        return $this->tradeId;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getLiquidity(): string
    {
        return $this->liquidity;
    }

    public function getFee(): float
    {
        return $this->fee;
    }

    public function isSettled(): bool
    {
        return $this->settled;
    }

    public function getSide(): string
    {
        return $this->side;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function getProfileId(): ?string
    {
        return $this->profileId;
    }

    public function getUsdVolume(): ?float
    {
        return $this->usdVolume;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        return new static(
            $array['trade_id'],
            $array['product_id'],
            $array['price'],
            $array['size'],
            $array['order_id'],
            $array['user_id'] ?? null,
            $array['profile_id'] ?? null,
            new DateTimeImmutable($array['created_at']),
            $array['liquidity'],
            $array['fee'],
            $array['settled'],
            $array['usd_volume'] ??  null,
            $array['side']
        );
    }

    public static function createCollectionFromJson(string $json, ...$divers): array
    {
        $collection = json_decode($json, true);
        foreach ($collection as $k => &$value) {
            $collection[$k] = self::createFromArray($value);
        }

        return $collection;
    }
}
