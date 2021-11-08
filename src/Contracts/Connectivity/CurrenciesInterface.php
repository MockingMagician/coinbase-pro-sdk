<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\CurrencyDataInterface;

interface CurrenciesInterface
{
    /**
     * Gets a list of all known currencies.
     * Note: Not all currencies may be currently in use for trading.
     *
     * Request : GET /currencies
     *
     * @return CurrencyDataInterface[]
     */
    public function list(): array;

    /**
     * Gets a single currency by id.
     *
     * Request : GET /currencies/{currency_id}
     */
    public function getCurrency(string $currencyId): CurrencyDataInterface;
}
