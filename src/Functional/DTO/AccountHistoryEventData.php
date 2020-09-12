<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountHistoryEventDataInterface;

class AccountHistoryEventData extends AbstractCreator implements AccountHistoryEventDataInterface
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
     * @var float
     */
    private $amount;
    /**
     * @var float
     */
    private $balance;
    /**
     * @var string
     */
    private $type;
    /**
     * @var array
     */
    private $details;

    public function __construct(
        string $id,
        DateTimeInterface $createdAt,
        float $amount,
        float $balance,
        string $type,
        array $details
    ) {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->amount = $amount;
        $this->balance = $balance;
        $this->type = $type;
        $this->details = $details;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        return new self(
            $array['id'],
            new DateTimeImmutable($array['created_at']),
            $array['amount'],
            $array['balance'],
            $array['type'],
            $array['details']
        );
    }
}
