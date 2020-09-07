<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\DepositDataInterface;

class DepositData implements DepositDataInterface
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
     * @var DateTimeImmutable
     */
    private $createdAt;
    /**
     * @var DateTimeImmutable
     */
    private $completedAt;
    /**
     * @var DateTimeImmutable
     */
    private $processedAt;
    /**
     * @var string
     */
    private $accountId;
    /**
     * @var string
     */
    private $userId;
    /**
     * @var int
     */
    private $userNonce;
    /**
     * @var float
     */
    private $amount;
    /**
     * @var array
     */
    private $details;

    public function __construct(
        string $id,
        string $type,
        DateTimeImmutable $createdAt,
        ?DateTimeImmutable $completedAt,
        ?DateTimeImmutable $processedAt,
        string $accountId,
        string $userId,
        int $userNonce,
        float $amount,
        array $details
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->createdAt = $createdAt;
        $this->completedAt = $completedAt;
        $this->processedAt = $processedAt;
        $this->accountId = $accountId;
        $this->userId = $userId;
        $this->userNonce = $userNonce;
        $this->amount = $amount;
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
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCompletedAt(): ?DateTimeInterface
    {
        return $this->completedAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getProcessedAt(): ?DateTimeInterface
    {
        return $this->processedAt;
    }

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getUserNonce(): int
    {
        return $this->userNonce;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
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
            $array['type'],
            new DateTimeImmutable($array['created_at']),
            $array['completed_at'] ? new DateTimeImmutable($array['completed_at']) : null,
            $array['processed_at'] ? new DateTimeImmutable($array['processed_at']) : null,
            $array['account_id'],
            $array['user_id'],
            $array['user_nonce'],
            $array['amount'],
            $array['details']
        );
    }

    public static function createCollectionFromJson(string $json)
    {
        $collection = json_decode($json, true);
        foreach ($collection as $k => $value) {
            $collection[$k] = self::createFromArray($value);
        }

        return $collection;
    }
}
