<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\CurrencyDetailsDataInterface;

class CurrencyDetailsData extends AbstractCreator implements CurrencyDetailsDataInterface
{
    /**
     * @var null|string
     */
    private $type;
    /**
     * @var null|string
     */
    private $symbol;
    /**
     * @var null|int
     */
    private $networkConfirmations;
    /**
     * @var null|int
     */
    private $sortOrder;
    /**
     * @var null|string
     */
    private $cryptoAddressLink;
    /**
     * @var null|string
     */
    private $cryptoTransactionLink;
    /**
     * @var null|array
     */
    private $pushPaymentMethods;
    /**
     * @var null|int
     */
    private $processingTimeSeconds;
    /**
     * @var null|float
     */
    private $minWithdrawalAmount;
    /**
     * @var null|float
     */
    private $maxWithdrawalAmount;
    /**
     * @var null|array
     */
    private $groupTypes;

    public function __construct(
        ?string $type,
        ?string $symbol,
        ?int $networkConfirmations,
        ?int $sortOrder,
        ?string $cryptoAddressLink,
        ?string $cryptoTransactionLink,
        ?array $pushPaymentMethods,
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function getNetworkConfirmations(): ?int
    {
        return $this->networkConfirmations;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function getCryptoAddressLink(): ?string
    {
        return $this->cryptoAddressLink;
    }

    public function getCryptoTransactionLink(): ?string
    {
        return $this->cryptoTransactionLink;
    }

    public function getPushPaymentMethods(): ?array
    {
        return $this->pushPaymentMethods;
    }

    public function getProcessingTimeSeconds(): ?int
    {
        return $this->processingTimeSeconds;
    }

    public function getMinWithdrawalAmount(): ?float
    {
        return $this->minWithdrawalAmount;
    }

    public function getMaxWithdrawalAmount(): ?float
    {
        return $this->maxWithdrawalAmount;
    }

    public function getGroupTypes(): ?array
    {
        return $this->groupTypes;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['type'] ?? null,
            $array['symbol'] ?? null,
            $array['network_confirmations'] ?? null,
            $array['sort_order'] ?? null,
            $array['crypto_address_link'] ?? null,
            $array['crypto_transaction_link'] ?? null,
            $array['push_payment_methods'] ?? null,
            $array['processing_time_seconds'] ?? null,
            $array['min_withdrawal_amount'] ?? null,
            $array['max_withdrawal_amount'] ?? null,
            $array['group_types'] ?? null
        );
    }
}
