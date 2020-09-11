<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\MarginStatusDataInterface;

class MarginStatus implements MarginStatusDataInterface
{
    /**
     * @var int
     */
    private $tier;
    /**
     * @var bool
     */
    private $enabled;
    /**
     * @var bool
     */
    private $eligible;

    public function __construct(
        int $tier,
        bool $enabled,
        bool $eligible
    ) {
        $this->tier = $tier;
        $this->enabled = $enabled;
        $this->eligible = $eligible;
    }

    /**
     * @return int
     */
    public function getTier(): int
    {
        return $this->tier;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return bool
     */
    public function isEligible(): bool
    {
        return $this->eligible;
    }

    public static function createFromArray(array $array)
    {
        return new self(
            $array['tier'],
            $array['enabled'],
            $array['eligible']
        );
    }

    public static function createFromJson(string $json)
    {
        return self::createFromArray(json_decode($json, true));
    }
}
