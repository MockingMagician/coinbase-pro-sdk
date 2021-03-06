<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

interface PaymentMethodDataInterface
{
    public function getId(): string;

    public function getType(): string;

    public function isVerified(): bool;

    public function getVerificationMethod(): ?string;

    public function getCdvStatus(): ?string;

    public function getName(): string;

    public function getCurrency(): string;

    public function isPrimaryBuy(): bool;

    public function isPrimarySell(): bool;

    public function isAllowBuy(): bool;

    public function isAllowSell(): bool;

    public function isAllowDeposit(): bool;

    public function isAllowWithdraw(): bool;

    public function getCreatedAt(): ?DateTimeInterface;

    public function getUpdatedAt(): ?DateTimeInterface;

    public function getResource(): ?string;

    public function getResourcePath(): ?string;

    public function getLimits(): PaymentMethodLimitsDataInterface;
}
