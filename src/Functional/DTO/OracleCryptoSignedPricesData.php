<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\OracleCryptoSignedPricesInterface;

class OracleCryptoSignedPricesData extends AbstractCreator implements OracleCryptoSignedPricesInterface
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

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function getSignatures(): array
    {
        return $this->signatures;
    }

    public function getPrices(): array
    {
        return $this->prices;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['timestamp'],
            $array['messages'],
            $array['signatures'],
            $array['prices']
        );
    }

    public static function createFromJson(string $json, ...$extraData)
    {
        return self::createFromArray(json_decode($json, true));
    }
}
