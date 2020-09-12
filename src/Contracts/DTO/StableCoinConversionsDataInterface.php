<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface StableCoinConversionsDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * {
 *  "id": "8942caee-f9d5-4600-a894-4811268545db",
 *  "amount": "10000.00",
 *  "from_account_id": "7849cc79-8b01-4793-9345-bc6b5f08acce",
 *  "to_account_id": "105c3e58-0898-4106-8283-dc5781cda07b",
 *  "from": "USD",
 *  "to": "USDC"
 * }
 */
interface StableCoinConversionsDataInterface
{
    public function getId(): string;
    public function getAmount(): float;
    public function getFromAccountId(): string;
    public function getToAccountId(): string;
    public function getFromCurrencyId(): string;
    public function getToCurrencyId(): string;
}
