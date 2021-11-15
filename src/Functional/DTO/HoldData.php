<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\HoldDataInterface;

class HoldData extends AbstractCreator implements HoldDataInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var DateTimeInterface
     */
    private $createdAt;
    /**
     * @var DateTimeInterface
     */
    private $updatedAt;
    /**
     * @var null|float
     */
    private $amount;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $ref;

    public function __construct(
        string $id,
        float $Amount,
        string $type,
        string $ref,
        DateTimeInterface $createdAt,
        ?DateTimeInterface $updatedAt
    ) {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->amount = $Amount;
        $this->type = $type;
        $this->ref = $ref;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getRef(): string
    {
        return $this->ref;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['id'],
            $array['amount'],
            $array['type'],
            $array['ref'],
            new DateTimeImmutable($array['created_at']),
            isset($array['updated_at']) ? new DateTimeImmutable($array['updated_at']) : null
        );
    }
}
