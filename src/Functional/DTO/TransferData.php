<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TransferDataInterface;

class TransferData extends AbstractCreator implements TransferDataInterface
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
    private $canceledAt;
    /**
     * @var DateTimeImmutable
     */
    private $processedAt;
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
        ?DateTimeImmutable $canceledAt,
        ?DateTimeImmutable $processedAt,
        string $accountId,
        string $userId,
        ?int $userNonce,
        float $amount,
        array $details
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->createdAt = $createdAt;
        $this->completedAt = $completedAt;
        $this->processedAt = $processedAt;
        $this->userNonce = $userNonce;
        $this->amount = $amount;
        $this->idem = $accountId;
        $this->userId = $userId;
        $this->details = $details;
        $this->canceledAt = $canceledAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

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
     * @return null|DateTimeImmutable
     */
    public function getCanceledAt(): ?DateTimeInterface
    {
        return $this->canceledAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getProcessedAt(): ?DateTimeInterface
    {
        return $this->processedAt;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getUserNonce(): ?int
    {
        return $this->userNonce;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['id'],
            $array['type'],
            new DateTimeImmutable($array['created_at']),
            isset($array['completed_at']) ? new DateTimeImmutable($array['completed_at']) : null,
            isset($array['canceled_at']) ? new DateTimeImmutable($array['canceled_at']) : null,
            isset($array['processed_at']) ? new DateTimeImmutable($array['processed_at']) : null,
            $array['account_id'],
            $array['user_id'],
            $array['user_nonce'],
            $array['amount'],
            $array['details']
        );
    }
}
