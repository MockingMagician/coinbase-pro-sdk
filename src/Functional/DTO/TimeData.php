<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\TimeDataInterface;

class TimeData extends AbstractCreator implements TimeDataInterface
{
    /**
     * @var string
     */
    private $iso;
    /**
     * @var float
     */
    private $epoch;

    public function __construct(string $iso, float $epoch)
    {
        $this->iso = $iso;
        $this->epoch = $epoch;
    }

    public function getIso(): string
    {
        return $this->iso;
    }

    public function getEpoch(): float
    {
        return $this->epoch;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static($array['iso'], (float) $array['epoch']);
    }
}
