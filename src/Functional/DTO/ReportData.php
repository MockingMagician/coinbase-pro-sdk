<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeImmutable;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\ReportDataInterface;

class ReportData extends AbstractCreator implements ReportDataInterface
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
    private $status;
    /**
     * @var null|DateTimeImmutable
     */
    private $createdAt;
    /**
     * @var null|DateTimeImmutable
     */
    private $completedAt;
    /**
     * @var null|DateTimeImmutable
     */
    private $expiredAt;
    /**
     * @var null|string
     */
    private $fileUrl;
    /**
     * @var array<string, mixed>
     */
    private $params;

    /**
     * ReportData constructor.
     *
     * @param array<string, mixed> $params
     */
    public function __construct(
        string $id,
        string $type,
        string $status,
        ?DateTimeImmutable $createdAt,
        ?DateTimeImmutable $completedAt,
        ?DateTimeImmutable $expiredAt,
        ?string $fileUrl,
        array $params
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->completedAt = $completedAt;
        $this->expiredAt = $expiredAt;
        $this->fileUrl = $fileUrl;
        $this->params = $params;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCompletedAt(): ?DateTimeImmutable
    {
        return $this->completedAt;
    }

    public function getExpiredAt(): ?DateTimeImmutable
    {
        return $this->expiredAt;
    }

    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return $this->params;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['id'],
            $array['type'],
            $array['status'],
            isset($array['created_at']) ? new DateTimeImmutable($array['created_at']) : null,
            isset($array['completed_at']) ? new DateTimeImmutable($array['completed_at']) : null,
            isset($array['expires_at']) ? new DateTimeImmutable($array['expires_at']) : null,
            $array['file_url'] ?? null,
            $array['params'] ?? []
        );
    }
}
