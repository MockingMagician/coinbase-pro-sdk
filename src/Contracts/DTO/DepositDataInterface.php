<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface DepositDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * {
 *   "id":"b6616e2f-67b7-4969-bea3-0f4f0e1b6fb4",
 *   "type":"deposit",
 *   "created_at":"2020-09-06 21:36:47.105222+00",
 *   "completed_at":null,"canceled_at":null,
 *   "processed_at":null,
 *   "account_id":"60b752df-0e87-40ec-b252-37533eadcb92",
 *   "user_id":"5e70d9c2371d9322ba7d99f5",
 *   "user_nonce":"1599428174689",
 *   "amount":"5000.00000000",
 *   "details":
 *   {
 *     "coinbase_payout_at":"2015-02-18T16:54:00-08:00",
 *     "coinbase_account_id":"bcdd4c40-df40-5d76-810c-74aab722b223",
 *     "coinbase_deposit_id":"67e0eaec-07d7-54c4-a72c-2e92826897df",
 *     "coinbase_payment_method_id":"6a23926d-74b6-4373-8434-9d437c2bafb2",
 *     "coinbase_payment_method_type":"ach_bank_account"
 *   }
 * }
 */
interface DepositDataInterface
{
    public function getId(): string;
    public function getType(): string;
    public function getCreatedAt(): DateTimeInterface;
    public function getCompletedAt(): ?DateTimeInterface;
    public function getProcessedAt(): ?DateTimeInterface;
    public function getAccountId(): string;
    public function getUserId(): string;
    public function getUserNonce(): int;
    public function getAmount(): float;
    public function getDetails(): array;
}
