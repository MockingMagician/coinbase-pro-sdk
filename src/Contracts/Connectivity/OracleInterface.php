<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


interface OracleInterface
{
    /**
     * Get cryptographically signed prices ready to be posted on-chain using Open Oracle smart contracts.
     *
     * HTTP REQUEST
     * GET /oracle
     *
     * API KEY PERMISSIONS
     * This endpoint requires the “view” permission and is accessible by any profile’s API key.
     *
     * DETAILS
     * ● timestamp field indicates when the latest datapoint was obtained.
     * ● messages array contains abi-encoded values [kind, timestamp, key, value], where kind always equals to 'prices',
     * timestamp is the time when the price was obtained, key is asset ticker (e.g. 'eth') and value is asset price.
     * ● signatures is an array of Ethereum-compatible ECDSA signatures for each message.
     * ● prices contains human-readable asset prices
     * @return array
     */
    public function getCryptographicallySignedPrices(): array;
}
