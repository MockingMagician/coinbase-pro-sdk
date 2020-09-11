<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface HoldDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 * [
 *    {
 *       "id": "82dcd140-c3c7-4507-8de4-2c529cd1a28f",
 *       "account_id": "e0b3f39a-183d-453e-b754-0c13e5bab0b3",
 *       "created_at": "2014-11-06T10:34:47.123456Z",
 *       "updated_at": "2014-11-06T10:40:47.123456Z",
 *       "amount": "4.23",
 *       "type": "order",
 *       "ref": "0a205de4-dd35-4370-a285-fe8fc375a273",
 *    },
 *    ...
 * ]
 */
interface HoldDataInterface
{
    public function getId(): string;
    public function getAccountId(): string;
    public function getCreatedAt(): DateTimeInterface;
    public function getUpdatedAt(): DateTimeInterface;
    public function getAmount(): float;
    public function getType(): float;
    public function getRef(): string;
}
