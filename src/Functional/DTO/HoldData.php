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
    private $Id;
    /**
     * @var string
     */
    private $AccountId;
    /**
     * @var DateTimeInterface
     */
    private $CreatedAt;
    /**
     * @var DateTimeInterface
     */
    private $UpdatedAt;
    /**
     * @var float
     */
    private $Amount;
    /**
     * @var float
     */
    private $Type;
    /**
     * @var string
     */
    private $Ref;

    public function __construct(
        string $Id,
        string $AccountId,
        DateTimeInterface $CreatedAt,
        DateTimeInterface $UpdatedAt,
        float $Amount,
        float $Type,
        string $Ref
    ) {
        $this->Id = $Id;
        $this->AccountId = $AccountId;
        $this->CreatedAt = $CreatedAt;
        $this->UpdatedAt = $UpdatedAt;
        $this->Amount = $Amount;
        $this->Type = $Type;
        $this->Ref = $Ref;
    }

    public function getId(): string
    {
        return $this->Id;
    }

    public function getAccountId(): string
    {
        return $this->AccountId;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function getAmount(): float
    {
        return $this->Amount;
    }

    public function getType(): float
    {
        return $this->Type;
    }

    public function getRef(): string
    {
        return $this->Ref;
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
