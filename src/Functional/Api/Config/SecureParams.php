<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Api\Config;

use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ParamsInterface;

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

    public function __construct(ParamsInterface $params)
    {
        $key = openssl_random_pseudo_bytes(256);
        $this->keyPath = tempnam(sys_get_temp_dir(), 'pke');
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

    public function __debugInfo()
    {
        return [];
    }

    private function initCipherAndIV()
    {
        $ciphers = openssl_get_cipher_methods();
        if (in_array('aes-256-gcm', $ciphers)) {
            $this->cipher = 'aes-256-gcm';
        } else {
            $this->cipher = $ciphers[0];
        }
        $ivLength = openssl_cipher_iv_length($this->cipher);
        $this->iv = openssl_random_pseudo_bytes($ivLength);
    }

    private function encryptParams(ParamsInterface $params): string
    {
        return openssl_encrypt(serialize($params), $this->cipher, file_get_contents($this->keyPath), 0, $this->iv, $this->tag);
    }

    private function getParams(): ParamsInterface
    {
        return unserialize(openssl_decrypt($this->params, $this->cipher, file_get_contents($this->keyPath), 0, $this->iv, $this->tag));
    }
}
