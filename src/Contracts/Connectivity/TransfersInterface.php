<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TransferDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Enum\TransferTypeEnum;

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
    public function depositFromCoinbase(float $amount, string $currency, string $coinbaseAccountId): string;

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
    public function depositFromPaymentMethod(float $amount, string $currency, string $paymentMethodId): string;

    /**
     * Gets a list of the user's linked payment methods.
     *
     * Request : GET /payment-method
     *
     * @return PaymentMethodDataInterface[]
     */
    public function listPaymentMethods(): array;

    /**
     * Gets a list of in-progress and completed transfers of funds in/out of any of the user's accounts.
     *
     * Request : GET /transfers
     *
     * API Key Permissions
     * This endpoint requires either the "view" or "trade" permission.
     *
     * @return TransferDataInterface[]
     */
    public function listTransfers(?TransferTypeEnum $type = null, ?PaginationInterface $pagination = null): array;

    /**
     * Get information on a single transfer.
     *
     * Request : GET /transfers/{transfer_id}
     *
     * API Key Permissions
     * This endpoint requires either the "view" or "trade" permission.
     */
    public function getTransfer(string $transferId): TransferDataInterface;

    /**
     * Withdraws funds from the specified profile_id to a www.coinbase.com wallet.
     *
     * Request : POST /withdrawals/coinbase-account
     *
     * API Key Permissions
     * This endpoint requires the "transfer" permission.
     *
     * @return string the deposit id, as example "593533d2-ff31-46e0-b22e-ca754147a96a"
     */
    public function withdrawToCoinbase(float $amount, string $currency, string $coinbaseAccountId): string;

    /**
     * Withdraws funds from the specified profile_id to a www.coinbase.com wallet.
     *
     * Request : POST /withdrawals/crypto
     *
     * API Key Permissions
     * This endpoint requires the "transfer" permission.
     *
     * @return string the deposit id, as example "593533d2-ff31-46e0-b22e-ca754147a96a"
     */
    public function withdrawToCryptoAddress(
        float $amount,
        string $currency,
        string $cryptoAddress,
        ?string $destinationTag = null,
        ?float $fee = null,
        ?int $nonce = null,
        ?string $twoFactorCode = null
    ): string;

    /**
     * Get fee estimate for crypto withdrawal.
     *
     * Request : GET /withdrawals/fee-estimate
     *
     * API Key Permissions
     * This endpoint requires the "transfer" permission. API key must belong to default profile.
     */
    public function getFeeEstimate(string $currency, string $cryptoAddress): float;

    /**
     * Withdraws funds from the specified profile_id to a linked external payment method.
     *
     * Request : POST /withdrawals/payment-methodk
     *
     * API Key Permissions
     * This endpoint requires the "transfer" permission.
     *
     * @return string the withdraw id, as example "593533d2-ff31-46e0-b22e-ca754147a96a"
     */
    public function withdrawToPaymentMethod(float $amount, string $currency, string $paymentMethodId): string;
}
