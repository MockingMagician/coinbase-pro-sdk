<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\HoldDataInterface;

class HoldData implements HoldDataInterface
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

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->Id;
    }

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->AccountId;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->CreatedAt;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->Amount;
    }

    /**
     * @return float
     */
    public function getType(): float
    {
        return $this->Type;
    }

    /**
     * @return string
     */
    public function getRef(): string
    {
        return $this->Ref;
    }

    public static function createFromArray(array $array)
    {
        return new self(
            $array['id'],
            $array['account_id'],
            new DateTimeImmutable($array['created_at']),
            new DateTimeImmutable($array['updated_at']),
            $array['amount'],
            $array['type'],
            $array['ref']
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
