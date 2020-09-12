<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProfileDataInterface;

class ProfileData extends AbstractCreator implements ProfileDataInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $userId;
    /**
     * @var string
     */
    private $name;
    /**
     * @var bool
     */
    private $active;
    /**
     * @var bool
     */
    private $default;
    /**
     * @var DateTimeInterface
     */
    private $createdAt;

    public function __construct(
        string $id,
        string $userId,
        string $name,
        bool  $active,
        bool  $default,
        DateTimeInterface $createdAt
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->active = $active;
        $this->default = $default;
        $this->createdAt = $createdAt;
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
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->default;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        return new self(
            $array['id'],
            $array['user_id'],
            $array['name'],
            $array['active'],
            $array['is_default'],
            new \DateTimeImmutable($array['created_at'])
        );
    }
}
