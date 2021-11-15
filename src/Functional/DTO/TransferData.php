<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeImmutable;
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
    /**
     * @var null|string
     */
    private $accountId;
    /**
     * @var null|string
     */
    private $userId;
    /**
     * @var null|string
     */
    private $idem;

    public function __construct(
        string $id,
        string $type,
        float $amount,
        DateTimeImmutable $createdAt,
        ?DateTimeImmutable $completedAt,
        ?DateTimeImmutable $canceledAt,
        ?DateTimeImmutable $processedAt,
        ?string $accountId,
        ?string $userId,
        ?string $idem,
        ?int $userNonce,
        array $details
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->amount = $amount;
        $this->createdAt = $createdAt;
        $this->completedAt = $completedAt;
        $this->canceledAt = $canceledAt;
        $this->processedAt = $processedAt;
        $this->userNonce = $userNonce;
        $this->details = $details;
        $this->accountId = $accountId;
        $this->userId = $userId;
        $this->idem = $idem;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCompletedAt(): ?DateTimeImmutable
    {
        return $this->completedAt;
    }

    public function getCanceledAt(): ?DateTimeImmutable
    {
        return $this->canceledAt;
    }

    public function getProcessedAt(): ?DateTimeImmutable
    {
        return $this->processedAt;
    }

    public function getUserNonce(): ?int
    {
        return $this->userNonce;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    public function getIdem(): ?string
    {
        return $this->idem;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['id'],
            $array['type'],
            $array['amount'],
            new DateTimeImmutable($array['created_at']),
            isset($array['completed_at']) ? new DateTimeImmutable($array['completed_at']) : null,
            isset($array['canceled_at']) ? new DateTimeImmutable($array['canceled_at']) : null,
            isset($array['processed_at']) ? new DateTimeImmutable($array['processed_at']) : null,
            $array['account_id'],
            $array['user_id'],
            $array['idem'],
            $array['user_nonce'],
            $array['details']
        );
    }
}
