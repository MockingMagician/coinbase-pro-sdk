<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeImmutable;

/**
 * Interface DepositDataInterface.
 */
interface TransferDataInterface
{
    public function getId(): string;

    public function getType(): string;

    public function getAmount(): float;

    public function getCreatedAt(): DateTimeImmutable;

    public function getCompletedAt(): ?DateTimeImmutable;

    public function getCanceledAt(): ?DateTimeImmutable;

    public function getProcessedAt(): ?DateTimeImmutable;

    public function getAccountId(): ?string;

    public function getUserId(): ?string;

    public function getIdem(): ?string;

    public function getUserNonce(): ?int;

    public function getDetails(): array;
}
