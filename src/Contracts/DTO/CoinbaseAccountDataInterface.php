<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Class CoinbaseAccountDataInterface.
 */
interface CoinbaseAccountDataInterface
{
    const FIELDS = ['id', 'name', 'balance', 'currency', 'type', 'primary', 'active', 'available_on_consumer', 'hold_balance', 'hold_currency'];

    public function getId(): string;

    public function getName(): string;

    public function getBalance(): float;

    public function getCurrency(): string;

    public function getType(): string;

    public function isPrimary(): bool;

    public function isActive(): bool;

    public function isAvailableOnConsumer(): bool;

    public function getHoldBalance(): float;

    public function getHoldCurrency(): string;

    public function getExtraData(): array;
}
