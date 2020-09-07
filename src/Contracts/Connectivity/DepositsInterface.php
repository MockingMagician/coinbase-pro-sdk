<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\CryptoDepositAddressDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\DepositDataInterface;

interface DepositsInterface
{
    /**
     * List Deposits
     *
     * Get a list of deposits from the profile of the API key, in descending order by created time.
     * See the Pagination section for retrieving additional entries after the first page.
     *
     * HTTP REQUEST
     * GET /transfers
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * QUERY PARAMETERS
     * You can request deposits within a certain time range using query parameters.
     *
     * Param    Required    Description
     * type    Yes    Set to deposit
     * profile_id    No    Limit list of deposits to this profile_id. By default, it retrieves deposits across all of the user's profiles
     * before    No    If before is set, then it returns deposits created after the before timestamp, sorted by oldest creation date
     * after    No    If after is set, then it returns deposits created before the after timestamp, sorted by newest
     * limit    No    Truncate list to this many deposits, capped at 100. Default is 100.
     *
     * @param string|null $profileId
     * @param DateTimeInterface|null $before
     * @param DateTimeInterface|null $after
     * @param int $limit
     * @return DepositDataInterface[]
     */
    public function listDeposits(
        ?string $profileId = null,
        ?DateTimeInterface $before = null,
        ?DateTimeInterface $after = null,
        ?int $limit = 100
    ): array;

    /**
     * Single Deposit
     * Get information on a single deposit.
     *
     * HTTP REQUEST
     * GET /transfers/:transfer_id
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * @param string $depositId
     * @return DepositDataInterface
     */
    public function getDeposit(string $depositId): DepositDataInterface;

    /**
     * Payment method
     * Deposit funds from a payment method. See the Payment Methods section for retrieving your payment methods.
     *
     * HTTP REQUEST
     * POST /deposits/payment-method
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "transfer" permission. API key must belong to default profile.
     *
     * PARAMETERS
     * Param    Description
     * amount    The amount to deposit
     * currency    The type of currency
     * payment_method_id    ID of the payment method
     *
     * @param float $amount
     * @param string $currency
     * @param string $paymentMethodId
     * @return string deposit id as example "593533d2-ff31-46e0-b22e-ca754147a96a"
     */
    public function doDeposit(float $amount, string $currency, string $paymentMethodId): string;

    /**
     * Coinbase
     *
     * Deposit funds from a coinbase account.
     * You can move funds between your Coinbase accounts and your Coinbase Pro trading accounts within your daily limits.
     * Moving funds between Coinbase and Coinbase Pro is instant and free.
     * See the Coinbase Accounts section for retrieving your Coinbase accounts.
     *
     * HTTP REQUEST
     * POST /deposits/coinbase-account
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "transfer" permission. API key must belong to default profile.
     *
     * PARAMETERS
     * Param    Description
     * amount    The amount to deposit
     * currency    The type of currency
     * coinbase_account_id    ID of the coinbase account
     *
     * @param float $amount
     * @param string $currency
     * @param string $coinbaseAccountId
     * @return string deposit id as example "593533d2-ff31-46e0-b22e-ca754147a96a"
     */
    public function doDepositFromCoinbase(float $amount, string $currency, string $coinbaseAccountId): string;

    /**
     * Generate a Crypto Deposit Address
     *
     * You can generate an address for crypto deposits.
     * See the Coinbase Accounts section for information on how to retrieve your coinbase account ID.
     *
     * HTTP REQUEST
     * POST /coinbase-accounts/<coinbase-account-id>/addresses
     *
     * API KEY PERMISSIONS
     * This endpoint requires the "transfer" permission. API key must belong to default profile.
     *
     * @return CryptoDepositAddressDataInterface
     */
    public function generateCryptoDepositAddress(): CryptoDepositAddressDataInterface;
}
