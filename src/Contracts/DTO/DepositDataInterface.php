<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface DepositDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * [
 *     {
 *         "id": "6cca6a14-a5e3-4219-9542-86123fc9d6c3",
 *         "type": "deposit",
 *         "created_at": "2019-06-18 01:37:48.78953+00",
 *         "completed_at": "2019-06-18 01:37:49.756147+00",
 *         "canceled_at": null,
 *         "processed_at": "2019-06-18 01:37:49.756147+00",
 *         "account_id": "bf091906-ca7f-499e-95fa-5bc15e918b46",
 *         "user_id": "5eeac63c90b913bf3cf7c92e",
 *         "user_nonce": null,
 *         "amount": "40.00000000",
 *         "details": {
 *             "crypto_address": "rw2ciyaNshpHe7bCHo4bRWq6pqqynnWKQg",
 *             "destination_tag": "379156162",
 *             "coinbase_account_id": "7f8803e2-1be5-4a29-bfd2-3bc6645f5a24",
 *             "destination_tag_name": "XRP Tag",
 *             "crypto_transaction_id": "5eeac64cc46b34f5332e5326",
 *             "coinbase_transaction_id": "5eeac652be6cf8b17f7625bd",
 *             "crypto_transaction_hash": "B918BF044B6ADA318B36F4F23E7EB141C15BF2B6CFB96FDFC674E907FE235FB1"
 *         }
 *     },
 *     ...
 * ]
 *
 */
interface DepositDataInterface
{
    public function getId(): string;

    public function getType(): string;

    public function getCreatedAt(): DateTimeInterface;

    public function getCompletedAt(): ?DateTimeInterface;

    public function getCanceledAt(): ?DateTimeInterface;

    public function getProcessedAt(): ?DateTimeInterface;

    public function getAccountId(): string;

    public function getUserId(): string;

    public function getUserNonce(): ?int;

    public function getAmount(): float;

    public function getDetails(): array;
}
