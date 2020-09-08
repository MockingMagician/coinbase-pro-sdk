<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\LimitsDataInterface;

class LimitsData implements LimitsDataInterface
{
    /**
     * @var string
     */
    private $limitCurrency;
    /**
     * @var array
     */
    private $transferLimits;

    public function __construct(string $limitCurrency, array $transferLimits)
    {
        $this->limitCurrency = $limitCurrency;
        $this->transferLimits = $transferLimits;
    }

    /**
     * @return string
     */
    public function getLimitCurrency(): string
    {
        return $this->limitCurrency;
    }

    /**
     * @return array
     */
    public function getTransferLimits(): array
    {
        return $this->transferLimits;
    }

    public static function createFromJson(string $json)
    {
        return self::createFromArray(json_decode($json, true));
    }

    public static function createFromArray(array $array)
    {
        return new self($array['limit_currency'], $array['transfer_limits']);
    }
}
