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
     * @var string
     */
    private $accountId;
    /**
     * @var DateTimeInterface
     */
    private $createdAt;
    /**
     * @var DateTimeInterface
     */
    private $updatedAt;
    /**
     * @var float
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
        string $accountId,
        DateTimeInterface $createdAt,
        DateTimeInterface $updatedAt,
        float $Amount,
        string $type,
        string $ref
    ) {
        $this->id = $id;
        $this->accountId = $accountId;
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

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function getAmount(): float
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

    public static function createFromArray(array $array, ...$divers)
    {
        return new static(
            $array['id'],
            $array['account_id'],
            new DateTimeImmutable($array['created_at']),
            new DateTimeImmutable($array['updated_at']),
            $array['amount'],
            $array['type'],
            $array['ref']
        );
    }
}
