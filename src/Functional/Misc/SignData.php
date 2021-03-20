<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Misc;

class SignData
{
    /**
     * @var string
     */
    private $signature;
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $passphrase;
    /**
     * @var float
     */
    private $timestamp;

    public function __construct(string $signature, string $key, string $passphrase, float $timestamp)
    {
        $this->signature = $signature;
        $this->key = $key;
        $this->passphrase = $passphrase;
        $this->timestamp = $timestamp;
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getPassphrase(): string
    {
        return $this->passphrase;
    }

    /**
     * @return float
     */
    public function getTimestamp(): float
    {
        return $this->timestamp;
    }
}
