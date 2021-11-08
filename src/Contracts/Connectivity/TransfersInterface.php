<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TransferDataInterface;

interface TransfersInterface
{
    /**
     * Deposits funds from a www.coinbase.com wallet to the specified profile_id.
     * You can move funds between your Coinbase accounts and your Coinbase Exchange trading accounts within your daily limits.
     * Moving funds between Coinbase and Coinbase Exchange is instant and free.
     * See the Coinbase Accounts section for retrieving your Coinbase accounts.
     *
     * Request : POST /deposits/coinbase-account
     *
     * API Key Permissions
     * This endpoint requires the "transfer" permission.
     *
     * @return string the deposit id, as example "593533d2-ff31-46e0-b22e-ca754147a96a"
     */
    public function doDepositFromCoinbase(float $amount, string $currency, string $coinbaseAccountId): string;

    /**
     * Deposits funds from a linked external payment method to the specified profile_id.
     *
     * Request : POST /deposits/payment-method
     *
     * API Key Permissions
     * This endpoint requires the "transfer" permission.
     *
     * @return string the deposit id, as example "593533d2-ff31-46e0-b22e-ca754147a96a"
     */
    public function doDepositFromPaymentMethod(float $amount, string $currency, string $paymentMethodId): string;

    /**
     * List Payment Methods.
     *
     * Gets a list of the user's linked payment methods.
     *
     * @return PaymentMethodDataInterface[]
     */
    public function listPaymentMethods(): array;

    /**
     * Gets a list of in-progress and completed transfers of funds in/out of any of the user's accounts.
     *
     * @return TransferDataInterface[]
     */
    public function listTransfers(): array;
}
