<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsDataInterface;

class PaymentMethodData extends AbstractCreator implements PaymentMethodDataInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var bool
     */
    private $primary_buy;
    /**
     * @var bool
     */
    private $primary_sell;
    /**
     * @var bool
     */
    private $allow_buy;
    /**
     * @var bool
     */
    private $allow_sell;
    /**
     * @var bool
     */
    private $allow_deposit;
    /**
     * @var bool
     */
    private $allow_withdraw;
    /**
     * @var PaymentMethodLimitsDataInterface
     */
    private $limits;
    /**
     * @var bool
     */
    private $verified;
    /**
     * @var null|string
     */
    private $verificationMethod;
    /**
     * @var null|string
     */
    private $cdvStatus;
    /**
     * @var null|DateTimeInterface
     */
    private $createdAt;
    /**
     * @var null|DateTimeInterface
     */
    private $updatedAt;
    /**
     * @var null|string
     */
    private $resource;
    /**
     * @var null|string
     */
    private $resource_path;

    public function __construct(
        string $id,
        string $type,
        bool $verified,
        ?string $verificationMethod,
        ?string $cdvStatus,
        string $name,
        string $currency,
        bool $primary_buy,
        bool $primary_sell,
        bool $allow_buy,
        bool $allow_sell,
        bool $allow_deposit,
        bool $allow_withdraw,
        ?DateTimeInterface $createdAt,
        ?DateTimeInterface $updatedAt,
        ?string $resource,
        ?string $resource_path,
        PaymentMethodLimitsDataInterface $limits
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->currency = $currency;
        $this->primary_buy = $primary_buy;
        $this->primary_sell = $primary_sell;
        $this->allow_buy = $allow_buy;
        $this->allow_sell = $allow_sell;
        $this->allow_deposit = $allow_deposit;
        $this->allow_withdraw = $allow_withdraw;
        $this->limits = $limits;
        $this->verified = $verified;
        $this->verificationMethod = $verificationMethod;
        $this->cdvStatus = $cdvStatus;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->resource = $resource;
        $this->resource_path = $resource_path;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function isPrimaryBuy(): bool
    {
        return $this->primary_buy;
    }

    public function isPrimarySell(): bool
    {
        return $this->primary_sell;
    }

    public function isAllowBuy(): bool
    {
        return $this->allow_buy;
    }

    public function isAllowSell(): bool
    {
        return $this->allow_sell;
    }

    public function isAllowDeposit(): bool
    {
        return $this->allow_deposit;
    }

    public function isAllowWithdraw(): bool
    {
        return $this->allow_withdraw;
    }

    public function getLimits(): PaymentMethodLimitsDataInterface
    {
        return $this->limits;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function getVerificationMethod(): ?string
    {
        return $this->verificationMethod;
    }

    public function getCdvStatus(): ?string
    {
        return $this->cdvStatus;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function getResource(): ?string
    {
        return $this->resource;
    }

    public function getResourcePath(): ?string
    {
        return $this->resource_path;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        return new static(
            $array['id'],
            $array['type'],
            $array['verified'] ?? false,
            $array['verification_method'] ?? null,
            $array['cdv_status'] ?? null,
            $array['name'],
            $array['currency'],
            $array['primary_buy'],
            $array['primary_sell'],
            $array['allow_buy'],
            $array['allow_sell'],
            $array['allow_deposit'],
            $array['allow_withdraw'],
            isset($array['created_at']) ? new DateTimeImmutable($array['created_at']) : null,
            isset($array['updated_at']) ? new DateTimeImmutable($array['updated_at']) : null,
            $array['resource'] ?? null,
            $array['resource_path'] ?? null,
            PaymentMethodLimitsData::createFromArray($array['limits'])
        );
    }
}
