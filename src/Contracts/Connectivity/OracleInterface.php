<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\OracleCryptoSignedPricesInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\OracleCryptoSignedPrices;

interface OracleInterface
{
    const COINBASE_ORACLE_PUBLIC_KEY = '0xfCEAdAFab14d46e20144F48824d0C09B1a03F2BC';
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
    public function getCryptographicallySignedPrices(): OracleCryptoSignedPricesInterface;
}
