<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeImmutable;

interface CoinbaseDepositAddressDataInterface
{
    public function getId(): string;

    public function getAddress(): string;

    public function getName(): string;

    public function getCallbackUrl(): ?string;

    public function getCreatedAt(): DateTimeImmutable;

    public function getUpdatedAt(): DateTimeImmutable;

    public function getResource(): ?string;

    public function getResourcePath(): ?string;

    public function isExchangeDepositAddress(): bool;
}
