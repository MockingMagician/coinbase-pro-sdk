<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface CurrencyDetailsDataInterface
 */
interface CurrencyDetailsDataInterface
{

    public function getId(): string;

    public function getName(): string;

    public function getMinSize(): float;

    public function getStatus(): ?string;

    public function getStatusMessage(): ?string;

    public function getMaxPrecision(): ?float;

    public function getDetails(): array;

    public function getExtraData(): array;
}
