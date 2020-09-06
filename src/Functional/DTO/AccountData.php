<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\AccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\AccountDataInterface;

class AccountData implements AccountDataInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var float
     */
    private $balance;
    /**
     * @var float
     */
    private $holdFunds;
    /**
     * @var float
     */
    private $availableFunds;
    /**
     * @var bool
     */
    private $isTradingEnabled;
    /**
     * @var string
     */
    private $profileId;

    public function __construct(
        string $id,
        string $currency,
        float $balance,
        float $holdFunds,
        float $availableFunds,
        bool $isTradingEnabled,
        string $profileId
    ) {
        $this->id = $id;
        $this->currency = $currency;
        $this->balance = $balance;
        $this->holdFunds = $holdFunds;
        $this->availableFunds = $availableFunds;
        $this->isTradingEnabled = $isTradingEnabled;
        $this->profileId = $profileId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getHoldFunds(): float
    {
        return $this->holdFunds;
    }

    public function getAvailableFunds(): float
    {
        return $this->availableFunds;
    }

    public function isTradingEnabled(): bool
    {
        return $this->isTradingEnabled;
    }

    public function getProfileId(): string
    {
        return $this->profileId;
    }

    public static function createFromArray(array $array)
    {
        return new self(
            $array['id'],
            $array['currency'],
            $array['balance'],
            $array['hold'],
            $array['available'],
            $array['trading_enabled'],
            $array['profile_id']
        );
    }

    public static function createFromJson(string $json)
    {
        return self::createFromArray(json_decode($json, true));
    }

    public static function createCollectionFromJson(string $json)
    {
        $collection = json_decode($json, true);
        foreach ($collection as $k => &$value) {
            $collection[$k] = self::createFromArray($value);
        }

        return $collection;
    }
}
