<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface FillDataInterface.
 */
interface FillDataInterface
{
    public function getTradeId(): int;

    public function getProductId(): string;

    public function getPrice(): float;

    public function getSize(): float;

    public function getOrderId(): string;

    public function getCreatedAt(): DateTimeInterface;

    public function getLiquidity(): string;

    public function getFee(): float;

    public function isSettled(): bool;

    public function getSide(): string;
}
