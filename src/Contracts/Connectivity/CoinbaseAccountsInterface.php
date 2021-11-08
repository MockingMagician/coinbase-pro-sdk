<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\CoinbaseAccountDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\CoinbaseDepositAddressDataInterface;

interface CoinbaseAccountsInterface
{
    /**
     * Gets all the user's available Coinbase wallets
     * (These are the wallets/accounts that are used for buying and selling on www.coinbase.com).
     *
     * Request : POST /coinbase-accounts
     *
     * API Key Permissions
     * This endpoint requires either the "view" or "trade" permission.
     *
     * @return CoinbaseAccountDataInterface[]
     */
    public function list(): array;

    /**
     * Generates a one-time crypto address for depositing crypto.
     *
     * Request : POST /coinbase-accounts/{account_id}/addresses
     *
     * API Key Permissions
     * This endpoint requires "trade" permission.
     */
    public function generateCryptoAddress(string $accountId): CoinbaseDepositAddressDataInterface;
}
