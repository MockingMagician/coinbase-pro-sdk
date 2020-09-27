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
    /**
     * @var string|null
     */
    private $status;
    /**
     * @var string|null
     */
    private $message;
    /**
     * @var float|null
     */
    private $maxPrecision;
    /**
     * @var array
     */
    private $details;

    public function __construct(string $id, string $name, float $minSize, ?string $status, ?string $message, ?float $maxPrecision, array $details, array $extraData = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->minSize = $minSize;
        $this->extraData = $extraData;
        $this->status = $status;
        $this->message = $message;
        $this->maxPrecision = $maxPrecision;
        $this->details = $details;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getMaxPrecision(): ?float
    {
        return $this->maxPrecision;
    }

    public function getDetails(): array
    {
        return $this->details;
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
            $array['status'] ?? null,
            $array['message'] ?? null,
            $array['max_precision'] ?? null,
            $array['details'] ?? [],
            $extraData
        );
    }
}
