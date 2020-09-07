<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface CryptoDepositAddressDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * From doc :
 *
 * {
 *   "id": "7b147f5d-79de-4d3b-b116-446b259f8765",
 *   "address": "cx3iotaZqweMa7bABi4bRWq6rpponnOIFa",
 *   "destination_tag": "3299925630",
 *   "address_info": {
 *     "address": "cx3iotaZqweMa7bABi4bRWq6rpponnOIFa",
 *     "destination_tag": "4938102"
 *   },
 *   "created_at": "2020-06-17T20:35:38Z",
 *   "updated_at": "2020-06-17T20:35:38Z",
 *   "network": "ripple",
 *   "resource": "address",
 *   "deposit_uri": "xrp:cx3iotaZqweMa7bABi4bRWq6rpponnOIFa?dt=4938102",
 *   "exchange_deposit_address": true
 * }
 *
 * From test api :
 *
 * {
 *   "id":"dd3183eb-af1d-5f5d-a90d-cbff946435ff",
 *   "address":"mswUGcPHp1YnkLCgF1TtoryqSc5E9Q8xFa",
 *   "name":"New exchange deposit address",
 *   "callback_url":null,
 *   "created_at":"2014-05-07T08:41:19-07:00",
 *   "updated_at":"2014-05-07T08:41:19-08:00",
 *   "resource":"address",
 *   "resource_path":"/v2/exchange/accounts/95671473-4dda-5264-a654-fc6923e8a334/addresses/dd3183eb-af1d-5f5d-a90d-cbff946435ff",
 *   "exchange_deposit_address":true
 * }
 */
interface CryptoDepositAddressDataInterface
{
    public function getId(): string;
    public function getAddress(): string;
    public function getDestinationTag(): ?int;
    public function getAddressInfo(): ?CryptoDepositAddressInfoDataInterface;
    public function getCallbackUrl(): ?string;
    public function getCreatedAt(): DateTimeInterface;
    public function getUpdatedAt(): DateTimeInterface;
    public function getNetwork(): ?string;
    public function getResource(): string;
    public function getResourcePath(): ?string;
    public function getDepositUri(): ?string;
    public function isExchangeDepositAddress(): bool;
}
