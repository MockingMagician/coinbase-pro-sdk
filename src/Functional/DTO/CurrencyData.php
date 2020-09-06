<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\CurrencyDataInterface;

class CurrencyData implements CurrencyDataInterface
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
    private $minSize;
    /**
     * @var array
     */
    private $extraData;

    public function __construct(string $id, string $name, float $minSize, array $extraData = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->minSize = $minSize;
        $this->extraData = $extraData;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMinSize(): float
    {
        return $this->minSize;
    }

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
            $array['min_size'],
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
