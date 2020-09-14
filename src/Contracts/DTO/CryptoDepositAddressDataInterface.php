<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface CryptoDepositAddressDataInterface.
 */
interface CryptoDepositAddressDataInterface
{
    public function getId(): string;

    public function getAddress(): string;

    public function getDestinationTag(): ?int;

    public function getAddressInfo(): ?CryptoDepositAddressInfoDataInterface;

    public function getCallbackUrl(): ?string;

    public function getCreatedAt(): DateTimeInterface;

    public function getUpdatedAt(): DateTimeInterface;

    public function getNetwork(): ?string;

    public function getResource(): string;

    public function getResourcePath(): ?string;

    public function getDepositUri(): ?string;

    public function isExchangeDepositAddress(): bool;
}
