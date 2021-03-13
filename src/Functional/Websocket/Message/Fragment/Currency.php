<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\Fragment;


class Currency
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
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $fundingAccountId;
    /**
     * @var string
     */
    private $statusMessage;
    /**
     * @var float
     */
    private $maxPrecision;
    /**
     * @var string[]
     */
    private $convertibleTo;
    /**
     * @var CurrencyDetails
     */
    private $details;

    public function __construct(
        string $id,
        string $name,
        float $minSize,
        string $status,
        string $fundingAccountId,
        string $statusMessage,
        float $maxPrecision,
        array $convertibleTo,
        CurrencyDetails $details
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->minSize = $minSize;
        $this->status = $status;
        $this->fundingAccountId = $fundingAccountId;
        $this->statusMessage = $statusMessage;
        $this->maxPrecision = $maxPrecision;
        $this->convertibleTo = $convertibleTo;
        $this->details = $details;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getMinSize(): float
    {
        return $this->minSize;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getFundingAccountId(): string
    {
        return $this->fundingAccountId;
    }

    /**
     * @return string
     */
    public function getStatusMessage(): string
    {
        return $this->statusMessage;
    }

    /**
     * @return float
     */
    public function getMaxPrecision(): float
    {
        return $this->maxPrecision;
    }

    /**
     * @return string[]
     */
    public function getConvertibleTo(): array
    {
        return $this->convertibleTo;
    }

    /**
     * @return CurrencyDetails
     */
    public function getDetails(): CurrencyDetails
    {
        return $this->details;
    }
}
