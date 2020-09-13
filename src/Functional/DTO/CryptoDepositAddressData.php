<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\CryptoDepositAddressDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\CryptoDepositAddressInfoDataInterface;

class CryptoDepositAddressData extends AbstractCreator implements CryptoDepositAddressDataInterface
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
     * @var null|int
     */
    private $destinationTag;
    /**
     * @var null|CryptoDepositAddressInfoDataInterface
     */
    private $addressInfo;
    /**
     * @var null|string
     */
    private $callbackUrl;
    /**
     * @var DateTimeInterface
     */
    private $createdAt;
    /**
     * @var DateTimeInterface
     */
    private $updated_At;
    /**
     * @var null|string
     */
    private $network;
    /**
     * @var string
     */
    private $resource;
    /**
     * @var null|string
     */
    private $resourcePath;
    /**
     * @var null|string
     */
    private $depositUri;
    /**
     * @var bool
     */
    private $exchangeDepositAddress;

    public function __construct(
        string $id,
        string $address,
        ?int $destinationTag,
        ?CryptoDepositAddressInfoDataInterface $addressInfo,
        ?string $callbackUrl,
        DateTimeInterface $createdAt,
        DateTimeInterface $updated_At,
        ?string $network,
        string $resource,
        ?string $resourcePath,
        ?string $depositUri,
        bool $exchangeDepositAddress
    ) {
        $this->id = $id;
        $this->address = $address;
        $this->destinationTag = $destinationTag;
        $this->addressInfo = $addressInfo;
        $this->callbackUrl = $callbackUrl;
        $this->createdAt = $createdAt;
        $this->updated_At = $updated_At;
        $this->network = $network;
        $this->resource = $resource;
        $this->resourcePath = $resourcePath;
        $this->depositUri = $depositUri;
        $this->exchangeDepositAddress = $exchangeDepositAddress;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getDestinationTag(): ?int
    {
        return $this->destinationTag;
    }

    public function getAddressInfo(): ?CryptoDepositAddressInfoDataInterface
    {
        return $this->addressInfo;
    }

    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updated_At;
    }

    public function getNetwork(): ?string
    {
        return $this->network;
    }

    public function getResource(): string
    {
        return $this->resource;
    }

    public function getResourcePath(): ?string
    {
        return $this->resourcePath;
    }

    public function getDepositUri(): ?string
    {
        return $this->depositUri;
    }

    public function isExchangeDepositAddress(): bool
    {
        return $this->exchangeDepositAddress;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        return new static(
            $array['id'],
            $array['address'],
            $array['destination_tag'] ?? null,
            isset($array['address_info']) ? CryptoDepositAddressInfoData::createFromArray($array['address_info'], $divers) : null,
            $array['callback_url'] ?? null,
            new DateTimeImmutable($array['created_at']),
            new DateTimeImmutable($array['updated_at']),
            $array['network'] ?? null,
            $array['resource'],
            $array['resource_path'] ?? null,
            $array['deposit_uri'] ?? null,
            $array['exchange_deposit_address']
        );
    }
}
