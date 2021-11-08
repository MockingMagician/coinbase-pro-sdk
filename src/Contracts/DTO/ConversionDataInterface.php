<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

interface ConversionDataInterface
{
    public function getId(): string;

    public function getAmount(): float;

    public function getFromAccountId(): string;

    public function getToAccountId(): string;

    public function getFrom(): ?string;

    public function getTo(): ?string;
}
