<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\CoinbaseAccountDataInterface;

interface CoinbaseAccountsInterface
{
    /**
     * Coinbase Accounts.
     *
     * List Accounts
     * Get a list of your coinbase accounts.
     * Visit the Coinbase accounts API for more information.
     *
     * HTTP REQUEST
     * GET /coinbase-accounts
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "transfer" permission.
     *
     * @return CoinbaseAccountDataInterface[]
     */
    public function listCoinbaseAccounts(): array;
}
