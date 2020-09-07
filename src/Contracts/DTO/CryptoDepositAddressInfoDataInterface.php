<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface CryptoDepositAddressDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * "address_info": {
 *   "address": "cx3iotaZqweMa7bABi4bRWq6rpponnOIFa",
 *   "destination_tag": "4938102"
 * }
 */
interface CryptoDepositAddressInfoDataInterface
{
    public function getAddress(): string;
    public function getDestinationTag(): int;
}
