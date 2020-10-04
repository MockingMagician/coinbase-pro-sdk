<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

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
        bool $active,
        bool $default,
        DateTimeInterface $createdAt
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->active = $active;
        $this->default = $default;
        $this->createdAt = $createdAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function isDefault(): bool
    {
        return $this->default;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['id'],
            $array['user_id'],
            $array['name'],
            $array['active'],
            $array['is_default'],
            new \DateTimeImmutable($array['created_at'])
        );
    }
}
