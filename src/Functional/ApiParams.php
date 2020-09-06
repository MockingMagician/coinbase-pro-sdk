<?php


namespace MockingMagician\CoinbaseProSdk\Functional;


use MockingMagician\CoinbaseProSdk\Contracts\ApiParamsInterface;

class ApiParams implements ApiParamsInterface
{
    /**
     * @var string
     */
    private $endpoint;
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $secret;
    /**
     * @var string
     */
    private $passphrase;

    public function __construct(string $endpoint, string $key, string $secret, string $passphrase)
    {
        $this->endpoint = $endpoint;
        $this->key = $key;
        $this->secret = $secret;
        $this->passphrase = $passphrase;
    }

    public function getEndPoint(): string
    {
        return $this->endpoint;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function getPassphrase(): string
    {
        return $this->passphrase;
    }
}
