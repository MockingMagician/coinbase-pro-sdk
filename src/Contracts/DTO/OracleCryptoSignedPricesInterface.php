<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Class OracleCryptoSignedPricesInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * {
 *     "timestamp": "1583195520",
 *     "messages": [
 *         "0x000000000020f35705800000000000....",
 *         "0x00000000000000000000000000000000005e5da5800000..."
 *     ],
 *     "signatures": [
 *         "0x8318875F720F88683B75C949A1E83FCEFBD586AE8A8276944F126CDBA176F3844B05C92D1B4393DCF1DAD2D59B88F196C9ABA988141265BDACBFDBC90049FA211c",
 *         "0x69BD1ECDF391B2A24D61C8FAB6FF1874DCC5CDCFB1B691DC14BC288503B0B460F43F5CDD83615B0D3E785110279A85C75E19C6ED3A645DC9A084B9BC6B8584BE1b"
 *     ],
 *     "prices": {
 *         "BTC": "8845.095000000001",
 *         "ETH": "228.85",
 *     }
 * }
 */
interface OracleCryptoSignedPricesInterface
{
    public function getTimestamp(): int;
    public function getMessages(): array;
    public function getSignatures(): array;
    public function getPrices(): array;
}
