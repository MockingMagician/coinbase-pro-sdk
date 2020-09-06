<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\CurrencyDataInterface;

interface CurrenciesInterface
{
    /**
     * Get currencies
     * List known currencies.
     *
     * HTTP REQUEST
     * GET /currencies
     * Not all currencies may be currently in use for trading.
     *
     * CURRENCY CODES
     * Currency codes will conform to the ISO 4217 standard where possible.
     * Currencies which have or had no representation in ISO 4217 may use a custom code.
     * Code	Description
     * BTC	Bitcoin
     * ETH	Ether
     * LTC	Litecoin
     *
     * @return CurrencyDataInterface[]
     */
    public function getCurrencies(): array;
}
