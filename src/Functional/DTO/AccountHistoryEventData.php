<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountHistoryEventDataInterface;

class AccountHistoryEventData implements AccountHistoryEventDataInterface
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

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    public static function createFromArray(array $array)
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

    public static function createCollectionFromJson(string $json)
    {
        $collection = json_decode($json, true);
        foreach ($collection as $k => $v) {
            $collection[$k] = self::createFromArray($v);
        }

        return $collection;
    }
}
