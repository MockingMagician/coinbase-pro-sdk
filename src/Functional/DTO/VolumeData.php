<?php


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

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @return float
     */
    public function getExchangeVolume(): float
    {
        return $this->exchangeVolume;
    }

    /**
     * @return float
     */
    public function getVolume(): float
    {
        return $this->volume;
    }

    /**
     * @return DateTimeInterface
     */
    public function getRecordedAt(): DateTimeInterface
    {
        return $this->recordedAt;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        return new static(
            $array['product_id'],
            $array['exchange_volume'],
            $array['volume'],
            new DateTimeImmutable($array['recorded_at'])
        );
    }
}
