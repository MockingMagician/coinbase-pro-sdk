<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\Fragment;


class CurrencyDetails
{
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $symbol;
    /**
     * @var int
     */
    private $networkConfirmation;
    /**
     * @var int
     */
    private $sortOrder;
    /**
     * @var string
     */
    private $cryptoAddressLink;
    /**
     * @var string
     */
    private $cryptoTransactionLink;
    /**
     * @var array
     */
    private $pushPaymentMethods;
    /**
     * @var int|null
     */
    private $processingTimeSeconds;
    /**
     * @var float
     */
    private $minWithdrawalAmount;
    /**
     * @var float
     */
    private $maxWithdrawalAmount;

    public function __construct(
        string $type,
        string $symbol,
        int $networkConfirmation,
        int $sortOrder,
        string $cryptoAddressLink,
        string $cryptoTransactionLink,
        array $pushPaymentMethods,
        ?int $processingTimeSeconds,
        ?float $minWithdrawalAmount,
        ?float $maxWithdrawalAmount
    ) {
        $this->type = $type;
        $this->symbol = $symbol;
        $this->networkConfirmation = $networkConfirmation;
        $this->sortOrder = $sortOrder;
        $this->cryptoAddressLink = $cryptoAddressLink;
        $this->cryptoTransactionLink = $cryptoTransactionLink;
        $this->pushPaymentMethods = $pushPaymentMethods;
        $this->processingTimeSeconds = $processingTimeSeconds;
        $this->minWithdrawalAmount = $minWithdrawalAmount;
        $this->maxWithdrawalAmount = $maxWithdrawalAmount;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @return int
     */
    public function getNetworkConfirmation(): int
    {
        return $this->networkConfirmation;
    }

    /**
     * @return int
     */
    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    /**
     * @return string
     */
    public function getCryptoAddressLink(): string
    {
        return $this->cryptoAddressLink;
    }

    /**
     * @return string
     */
    public function getCryptoTransactionLink(): string
    {
        return $this->cryptoTransactionLink;
    }

    /**
     * @return array
     */
    public function getPushPaymentMethods(): array
    {
        return $this->pushPaymentMethods;
    }

    /**
     * @return int|null
     */
    public function getProcessingTimeSeconds(): ?int
    {
        return $this->processingTimeSeconds;
    }

    /**
     * @return float
     */
    public function getMinWithdrawalAmount(): float
    {
        return $this->minWithdrawalAmount;
    }

    /**
     * @return float
     */
    public function getMaxWithdrawalAmount(): float
    {
        return $this->maxWithdrawalAmount;
    }
}
