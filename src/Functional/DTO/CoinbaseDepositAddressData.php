<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeImmutable;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\CoinbaseDepositAddressDataInterface;

class CoinbaseDepositAddressData extends AbstractCreator implements CoinbaseDepositAddressDataInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $address;
    /**
     * @var string
     */
    private $name;
    /**
     * @var null|string
     */
    private $callbackUrl;
    /**
     * @var DateTimeImmutable
     */
    private $createdAt;
    /**
     * @var DateTimeImmutable
     */
    private $updatedAt;
    /**
     * @var null|string
     */
    private $resource;
    /**
     * @var null|string
     */
    private $resourcePath;
    /**
     * @var bool
     */
    private $isExchangeDepositAddress;

    public function __construct(
        string $id,
        string $address,
        string $name,
        ?string $callbackUrl,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        ?string $resource,
        ?string $resourcePath,
        bool $isExchangeDepositAddress
    ) {
        $this->id = $id;
        $this->address = $address;
        $this->name = $name;
        $this->callbackUrl = $callbackUrl;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->resource = $resource;
        $this->resourcePath = $resourcePath;
        $this->isExchangeDepositAddress = $isExchangeDepositAddress;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getResource(): ?string
    {
        return $this->resource;
    }

    public function getResourcePath(): ?string
    {
        return $this->resourcePath;
    }

    public function isExchangeDepositAddress(): bool
    {
        return $this->isExchangeDepositAddress;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['id'],
            $array['address'],
            $array['name'],
            $array['callback_url'],
            new DateTimeImmutable($array['created_at']),
            new DateTimeImmutable($array['updated_at']),
            $array['updated_at'],
            $array['resource_path'],
            $array['exchange_deposit_address']
        );
    }
}
