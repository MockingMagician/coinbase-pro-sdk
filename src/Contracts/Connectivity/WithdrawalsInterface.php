<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\WithdrawalsDataInterface;

interface WithdrawalsInterface
{
    /**
     * List Withdrawals
     *
     * Get a list of withdrawals from the profile of the API key, in descending order by created time.
     * See the Pagination section for retrieving additional entries after the first page.
     *
     * HTTP REQUEST
     * GET /transfers
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * QUERY PARAMETERS
     * You can request withdrawals within a certain time range using query parameters.
     *
     * Param    Required    Description
     * type    Yes    Set to withdraw
     * profile_id    No    Limit list of withdrawals to this profile_id. By default, it retrieves withdrawals across all of the user's profiles
     * before    No    If before is set, then it returns withdrawals created after the before timestamp, sorted by oldest creation date
     * after    No    If after is set, then it returns withdrawals created before the after timestamp, sorted by newest
     * limit    No    Truncate list to this many withdrawals, capped at 100. Default is 100.
     *
     * @param string|null $profileId
     * @param PaginationInterface|null $pagination
     * @return WithdrawalsDataInterface[]
     */
    public function listWithdrawals(?string $profileId = null, PaginationInterface $pagination = null): array;

    /**
     * Single Withdrawal
     *
     * Get information on a single withdrawal.
     *
     * HTTP REQUEST
     * GET /transfers/:transfer_id
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permissio
     *
     * @param string $transferId
     * @return WithdrawalsDataInterface
     */
    public function getWithdrawal(string $transferId): WithdrawalsDataInterface;

    /**
     * Payment method
     * Withdraw funds to a payment method. See the Payment Methods section for retrieving your payment methods.
     *
     * HTTP REQUEST
     * POST /withdrawals/payment-method
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "transfer" permission. API key is restricted to the default profile.
     *
     * PARAMETERS
     * Param    Description
     * amount    The amount to withdraw
     * currency    The type of currency
     * payment_method_id    ID of the payment method
     *
     * @param float $amount
     * @param string $currency
     * @param string $paymentMethodId
     * @return string id of withdraw as is "593533d2-ff31-46e0-b22e-ca754147a96a"
     */
    public function withdraw(float $amount, string $currency, string $paymentMethodId): string;

    /**
     * Coinbase
     *
     * Withdraw funds to a coinbase account.
     * You can move funds between your Coinbase accounts and your Coinbase Pro trading accounts within your daily limits.
     * Moving funds between Coinbase and Coinbase Pro is instant and free.
     * See the Coinbase Accounts section for retrieving your Coinbase accounts.
     *
     * HTTP REQUEST
     * POST /withdrawals/coinbase-account
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "transfer" permission.
     *
     * PARAMETERS
     * Param    Description
     * amount    The amount to withdraw
     * currency    The type of currency
     * coinbase_account_id    ID of the coinbase account
     *
     * @param float $amount
     * @param string $currency
     * @param string $coinbaseAccountId
     * @return string
     */
    public function withdrawToCoinbase(float $amount, string $currency, string $coinbaseAccountId): string;

    /**
     *Crypto
     *
     * Withdraws funds to a crypto address.
     *
     * HTTP REQUEST
     * POST /withdrawals/crypto
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "transfer" permission. API key must belong to default profile.
     *
     * PARAMETERS
     * Param	Description
     * amount	The amount to withdraw
     * currency	The type of currency
     * crypto_address	A crypto address of the recipient
     * destination_tag	A destination tag for currencies that support one
     * no_destination_tag	A boolean flag to opt out of using a destination tag for currencies that support one.
     * This is required when not providing a destination tag.
     *
     * @param float $amount
     * @param string $currency
     * @param string $cryptoAddress
     * @param string|null $destinationTag
     * @return string
     */
    public function withdrawToCryptoAddress(float $amount, string $currency, string $cryptoAddress, string $destinationTag = null): string;
}
