<?php


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
     * @var DateTimeImmutable|null
     */
    private $createdAt;
    /**
     * @var DateTimeImmutable|null
     */
    private $completedAt;
    /**
     * @var DateTimeImmutable|null
     */
    private $expiredAt;
    /**
     * @var string|null
     */
    private $fileUrl;
    /**
     * @var array
     */
    private $params;

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
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getCompletedAt(): ?DateTimeImmutable
    {
        return $this->completedAt;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getExpiredAt(): ?DateTimeImmutable
    {
        return $this->expiredAt;
    }

    /**
     * @return string|null
     */
    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        return new self(
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
