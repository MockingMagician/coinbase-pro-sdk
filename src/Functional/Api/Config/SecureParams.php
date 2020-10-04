<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Api\Config;

use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ParamsInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class SecureParams implements ParamsInterface
{
    /**
     * @var string
     */
    private $iv;
    /**
     * @var string
     */
    private $cipher;
    /**
     * @var string
     */
    private $tag;
    /**
     * @var string
     */
    private $params;
    /**
     * @var string
     */
    private $keyPath;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(ParamsInterface $params)
    {
        $key = openssl_random_pseudo_bytes(256);
        $keyPath = tempnam(sys_get_temp_dir(), 'pke');
        if (!$keyPath) {
            throw new ApiError('Secure params layer must be able to create a temp file. Temporary dir must to be writable');
        }
        $this->keyPath = $keyPath;
        file_put_contents($this->keyPath, $key);
        $this->initCipherAndIV();
        $this->params = $this->encryptParams($params);
    }

    public function getEndPoint(): string
    {
        return $this->getParams()->getEndPoint();
    }

    public function getKey(): string
    {
        return $this->getParams()->getKey();
    }

    public function getSecret(): string
    {
        return $this->getParams()->getSecret();
    }

    public function getPassphrase(): string
    {
        return $this->getParams()->getPassphrase();
    }

    /**
     * @codeCoverageIgnore
     * @return mixed[]
     */
    public function __debugInfo()
    {
        return [];
    }

    /**
     * @codeCoverageIgnore
     */
    private function initCipherAndIV(): void
    {
        $ciphers = openssl_get_cipher_methods();
        if (in_array('aes-256-gcm', $ciphers)) {
            $this->cipher = 'aes-256-gcm';
        } else {
            $this->cipher = $ciphers[0];
        }
        $ivLength = openssl_cipher_iv_length($this->cipher);
        if (false === $ivLength) {
            throw new ApiError(sprintf('Secure params has failed to determine the initialisation vector length for cipher %s', $this->cipher));
        }
        $iv = openssl_random_pseudo_bytes($ivLength);
        if (!$iv) {
            throw new ApiError('Secure params has failed to create the initialisation vector');
        }
        $this->iv = $iv;
    }

    /**
     * @codeCoverageIgnore
     */
    private function encryptParams(ParamsInterface $params): string
    {
        $key = file_get_contents($this->keyPath);
        if (false === $key) {
            throw new ApiError('Secure params has failed to load the key');
        }
        $encrypted = openssl_encrypt(serialize($params), $this->cipher, $key, 0, $this->iv, $this->tag);
        if (false === $encrypted) {
            throw new ApiError('Secure params has failed to encrypt params');
        }

        return $encrypted;
    }

    /**
     * @codeCoverageIgnore
     */
    private function getParams(): ParamsInterface
    {
        $key = file_get_contents($this->keyPath);
        if (false === $key) {
            throw new ApiError('Secure params has failed to load the key');
        }

        $decrypted = openssl_decrypt($this->params, $this->cipher, $key, 0, $this->iv, $this->tag);
        if (false === $decrypted) {
            throw new ApiError('Secure params has failed to decrypt params');
        }

        $params = unserialize($decrypted);
        if (!$params instanceof ParamsInterface) {
            throw new ApiError('Secure params has failed to decrypt params');
        }

        return $params;
    }
}
