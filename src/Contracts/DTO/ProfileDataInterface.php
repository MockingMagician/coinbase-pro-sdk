<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface ProfileDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * {
 * "id": "86602c68-306a-4500-ac73-4ce56a91d83c",
 * "user_id": "5844eceecf7e803e259d0365",
 * "name": "default",
 * "active": true,
 * "is_default": true,
 * "created_at": "2019-11-18T15:08:40.236309Z"
 * }
 */
interface ProfileDataInterface
{
    public function getId(): string;
    public function getUserId(): string;
    public function getName(): string;
    public function isActive(): bool ;
    public function isDefault(): bool ;
    public function getCreatedAt(): DateTimeInterface;
}
