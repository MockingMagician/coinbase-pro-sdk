<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface AccountDataInterface.
 */
interface AccountDataInterface
{
    public function getId(): string;

    public function getCurrency(): string;

    public function getBalance(): float;

    public function getHoldFunds(): float;

    public function getAvailableFunds(): float;

    public function isTradingEnabled(): bool;

    public function getProfileId(): string;
}
