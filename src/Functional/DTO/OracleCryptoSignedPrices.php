<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\OracleInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OracleCryptoSignedPricesInterface;

class OracleCryptoSignedPrices implements OracleCryptoSignedPricesInterface
{
    /**
     * @var int
     */
    private $timestamp;
    /**
     * @var array
     */
    private $messages;
    /**
     * @var array
     */
    private $signatures;
    /**
     * @var array
     */
    private $prices;

    public function __construct(
        int $timestamp,
        array $messages,
        array $signatures,
        array $prices
    ) {
        $this->timestamp = $timestamp;
        $this->messages = $messages;
        $this->signatures = $signatures;
        $this->prices = $prices;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @return array
     */
    public function getSignatures(): array
    {
        return $this->signatures;
    }

    /**
     * @return array
     */
    public function getPrices(): array
    {
        return $this->prices;
    }

    public static function createFromArray(array $array)
    {
        return new self(
            $array['timestamp'],
            $array['messages'],
            $array['signatures'],
            $array['prices']
        );
    }

    public static function createFromJson(string $json)
    {
        return self::createFromArray(json_decode($json, true));
    }
}
