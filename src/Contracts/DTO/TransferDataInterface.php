<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface DepositDataInterface.
 */
interface TransferDataInterface
{
    public const TYPE_WITHDRAW = 'withdraw';
    public const TYPE_DEPOSIT = 'deposit';
    public const TYPES = [
        self::TYPE_DEPOSIT,
        self::TYPE_WITHDRAWT,
    ];

    public function getId(): string;

    public function getType(): string;

    public function getCreatedAt(): DateTimeInterface;

    public function getCompletedAt(): ?DateTimeInterface;

    public function getCanceledAt(): ?DateTimeInterface;

    public function getProcessedAt(): ?DateTimeInterface;

    public function getAccountId(): string;

    public function getUserId(): string;

    public function getUserNonce(): ?int;

    public function getAmount(): float;

    public function getDetails(): array;
}
