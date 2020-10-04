<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface ProductDataInterface.
 */
interface ProductDataInterface
{
    public function getId(): string;

    public function getDisplayName(): string;

    public function getBaseCurrency(): string;

    public function getQuoteCurrency(): string;

    public function getBaseIncrement(): float;

    public function getQuoteIncrement(): float;

    public function getBaseMinSize(): float;

    public function getBaseMaxSize(): float;

    public function getMinMarketFunds(): float;

    public function getMaxMarketFunds(): float;

    public function getStatus(): string;

    public function getStatusMessage(): string;

    public function isCancelOnly(): bool;

    public function isLimitOnly(): bool;

    public function isPostOnly(): bool;

    public function isTradingDisabled(): bool;

    public function isMarginEnabled(): bool;

    public function isTradingFullyOperational(): bool;
}
