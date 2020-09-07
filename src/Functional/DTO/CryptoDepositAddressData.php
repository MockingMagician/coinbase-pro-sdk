<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\CryptoDepositAddressDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\CryptoDepositAddressInfoDataInterface;

class CryptoDepositAddressData implements CryptoDepositAddressDataInterface
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
     * @var int|null
     */
    private $destinationTag;
    /**
     * @var CryptoDepositAddressInfoDataInterface|null
     */
    private $addressInfo;
    /**
     * @var string|null
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
     * @var string|null
     */
    private $network;
    /**
     * @var string
     */
    private $resource;
    /**
     * @var string|null
     */
    private $resourcePath;
    /**
     * @var string|null
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
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return int|null
     */
    public function getDestinationTag(): ?int
    {
        return $this->destinationTag;
    }

    /**
     * @return CryptoDepositAddressInfoDataInterface|null
     */
    public function getAddressInfo(): ?CryptoDepositAddressInfoDataInterface
    {
        return $this->addressInfo;
    }

    /**
     * @return string|null
     */
    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updated_At;
    }

    /**
     * @return string|null
     */
    public function getNetwork(): ?string
    {
        return $this->network;
    }

    /**
     * @return string
     */
    public function getResource(): string
    {
        return $this->resource;
    }

    /**
     * @return string|null
     */
    public function getResourcePath(): ?string
    {
        return $this->resourcePath;
    }

    /**
     * @return string|null
     */
    public function getDepositUri(): ?string
    {
        return $this->depositUri;
    }

    /**
     * @return bool
     */
    public function isExchangeDepositAddress(): bool
    {
        return $this->exchangeDepositAddress;
    }


    public static function createFromJson(string $json)
    {
        return self::createFromArray(json_decode($json, true));
    }

    public static function createFromArray(array $array)
    {
        return new self(
            $array['id'],
            $array['address'],
            $array['destination_tag'] ?? null,
            isset($array['address_info']) ? CryptoDepositAddressInfoData::createFromArray($array['address_info']) : null,
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
