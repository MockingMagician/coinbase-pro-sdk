<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\CurrencyDataInterface;

class CurrencyData extends AbstractCreator implements CurrencyDataInterface
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

    public static function createFromArray(array $array, ...$divers)
    {
        $extraData = [];

        foreach ($array as $k => $value) {
            if (!in_array($k, self::FIELDS)) {
                $extraData[$k] = $value;
            }
        }

        return new static(
            $array['id'],
            $array['name'],
            $array['min_size'],
            $extraData
        );
    }
}
