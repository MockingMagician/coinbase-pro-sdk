<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface AccountHistoryDataInterface.
 */
interface AccountHistoryEventDataInterface
{
    const TYPE_TRANSFER = 'transfer';
    const TYPE_MATCH = 'match';
    const TYPE_FEE = 'fee';
    const TYPE_REBATE = 'rebate';
    const TYPE_CONVERSION = 'conversion';
    const TYPES = [
        self::TYPE_TRANSFER,
        self::TYPE_MATCH,
        self::TYPE_FEE,
        self::TYPE_REBATE,
        self::TYPE_CONVERSION,
    ];

    public function getId(): string;

    public function getCreatedAt(): DateTimeInterface;

    public function getAmount(): float;

    public function getBalance(): float;

    public function getType(): string;

    public function getDetails(): array;
}
