<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\VolumeDataInterface;

class VolumeData extends AbstractCreator implements VolumeDataInterface
{
    /**
     * @var string
     */
    private $productId;
    /**
     * @var float
     */
    private $exchangeVolume;
    /**
     * @var float
     */
    private $volume;
    /**
     * @var DateTimeInterface
     */
    private $recordedAt;

    public function __construct(
        string $productId,
        float $exchangeVolume,
        float $volume,
        DateTimeInterface $recordedAt
    ) {
        $this->productId = $productId;
        $this->exchangeVolume = $exchangeVolume;
        $this->volume = $volume;
        $this->recordedAt = $recordedAt;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getExchangeVolume(): float
    {
        return $this->exchangeVolume;
    }

    public function getVolume(): float
    {
        return $this->volume;
    }

    public function getRecordedAt(): DateTimeInterface
    {
        return $this->recordedAt;
    }

    /**
     * @{inhetitedDoc}
     */
    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['product_id'],
            $array['exchange_volume'],
            $array['volume'],
            new DateTimeImmutable($array['recorded_at'])
        );
    }
}
