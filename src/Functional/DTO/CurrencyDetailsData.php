<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\CurrencyDetailsDataInterface;

class CurrencyDetailsData extends AbstractCreator implements CurrencyDetailsDataInterface
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
    private $networkConfirmations;
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
     * @var int
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
    /**
     * @var array|null
     */
    private $groupTypes;

    public function __construct(
        string $type,
        string $symbol,
        int $networkConfirmations,
        int $sortOrder,
        string $cryptoAddressLink,
        string $cryptoTransactionLink,
        array $pushPaymentMethods,
        ?int $processingTimeSeconds,
        ?float $minWithdrawalAmount,
        ?float $maxWithdrawalAmount,
        ?array $groupTypes
    ) {
        $this->type = $type;
        $this->symbol = $symbol;
        $this->networkConfirmations = $networkConfirmations;
        $this->sortOrder = $sortOrder;
        $this->cryptoAddressLink = $cryptoAddressLink;
        $this->cryptoTransactionLink = $cryptoTransactionLink;
        $this->pushPaymentMethods = $pushPaymentMethods;
        $this->processingTimeSeconds = $processingTimeSeconds;
        $this->minWithdrawalAmount = $minWithdrawalAmount;
        $this->maxWithdrawalAmount = $maxWithdrawalAmount;
        $this->groupTypes = $groupTypes;
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
    public function getNetworkConfirmations(): int
    {
        return $this->networkConfirmations;
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
     * @return int
     */
    public function getProcessingTimeSeconds(): ?int
    {
        return $this->processingTimeSeconds;
    }

    /**
     * @return float
     */
    public function getMinWithdrawalAmount(): ?float
    {
        return $this->minWithdrawalAmount;
    }

    /**
     * @return float
     */
    public function getMaxWithdrawalAmount(): ?float
    {
        return $this->maxWithdrawalAmount;
    }

    /**
     * @return array|null
     */
    public function getGroupTypes(): ?array
    {
        return $this->groupTypes;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['type'],
            $array['symbol'],
            $array['network_confirmations'],
            $array['sort_order'],
            $array['crypto_address_link'],
            $array['crypto_transaction_link'],
            $array['push_payment_methods'],
            $array['processing_time_seconds'] ?? null,
            $array['min_withdrawal_amount'] ?? null,
            $array['max_withdrawal_amount'] ?? null,
            $array['group_types'] ?? null
        );
    }
}
