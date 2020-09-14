<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\MarginStatusDataInterface;

class MarginStatus extends AbstractCreator implements MarginStatusDataInterface
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

    public function getTier(): int
    {
        return $this->tier;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function isEligible(): bool
    {
        return $this->eligible;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        return new static(
            $array['tier'],
            $array['enabled'],
            $array['eligible']
        );
    }

    public static function createFromJson(string $json, ...$divers)
    {
        return self::createFromArray(json_decode($json, true));
    }
}
