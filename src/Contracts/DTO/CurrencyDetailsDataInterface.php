<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface CurrencyDetailsDataInterface.
 */
interface CurrencyDetailsDataInterface
{
    public function getType(): string;

    public function getSymbol(): string;

    public function getNetworkConfirmations(): int;

    public function getSortOrder(): int;

    public function getCryptoAddressLink(): string;

    public function getCryptoTransactionLink(): string;

    public function getPushPaymentMethods(): array;

    public function getProcessingTimeSeconds(): ?int;

    public function getMinWithdrawalAmount(): ?float;

    public function getMaxWithdrawalAmount(): ?float;

    public function getGroupTypes(): ?array;
}
