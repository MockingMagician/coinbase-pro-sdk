<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\LimitsDataInterface;

class LimitsData extends AbstractCreator implements LimitsDataInterface
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

    public function getLimitCurrency(): string
    {
        return $this->limitCurrency;
    }

    public function getTransferLimits(): array
    {
        return $this->transferLimits;
    }

    public static function createFromJson(string $json, ...$extraData)
    {
        return self::createFromArray(json_decode($json, true));
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static($array['limit_currency'], $array['transfer_limits']);
    }
}
