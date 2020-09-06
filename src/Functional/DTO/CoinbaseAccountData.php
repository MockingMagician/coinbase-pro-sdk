<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\CoinbaseAccountDataInterface;

class CoinbaseAccountData implements CoinbaseAccountDataInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var float
     */
    private $balance;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $type;
    /**
     * @var bool
     */
    private $primary;
    /**
     * @var bool
     */
    private $active;
    /**
     * @var array
     */
    private $extraData;

    public function __construct(
        string $id,
        string $name,
        float $balance,
        string $currency,
        string $type,
        bool $primary,
        bool $active,
        array $extraData = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->balance = $balance;
        $this->currency = $currency;
        $this->type = $type;
        $this->primary = $primary;
        $this->active = $active;
        $this->extraData = $extraData;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isPrimary(): bool
    {
        return $this->primary;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return array
     */
    public function getExtraData(): array
    {
        return $this->extraData;
    }

    public static function createFromArray(array $array): self
    {
        $extraData = [];

        foreach ($array as $k => $value) {
            if (!in_array($k, self::FIELDS)) {
                $extraData[$k] = $value;
            }
        }

        return new self(
            $array['id'],
            $array['name'],
            $array['balance'],
            $array['currency'],
            $array['type'],
            $array['primary'],
            $array['active'],
            $extraData
        );
    }

    public static function createCollectionFromJson(string $json): array
    {
        $collection = json_decode($json, true);
        foreach ($collection as $k => $value) {
            $collection[$k] = self::createFromArray($value);
        }

        return $collection;
    }
}
