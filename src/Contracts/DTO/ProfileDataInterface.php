<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface ProfileDataInterface.
 */
interface ProfileDataInterface
{
    public function getId(): string;

    public function getUserId(): string;

    public function getName(): string;

    public function isActive(): bool;

    public function isDefault(): bool;

    public function getCreatedAt(): DateTimeInterface;
}
