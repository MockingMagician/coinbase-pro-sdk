<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\CoinbaseAccountDataInterface;

class CoinbaseAccountData extends AbstractCreator implements CoinbaseAccountDataInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var float
     */
    private $balance;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $type;
    /**
     * @var bool
     */
    private $primary;
    /**
     * @var bool
     */
    private $active;
    /**
     * @var array
     */
    private $extraData;
    /**
     * @var bool
     */
    private $availableOnConsumer;
    /**
     * @var float
     */
    private $holdBalance;
    /**
     * @var string
     */
    private $holdCurrency;

    public function __construct(
        string $id,
        string $name,
        float $balance,
        string $currency,
        string $type,
        bool $primary,
        bool $active,
        bool $availableOnConsumer,
        float $holdBalance,
        string $holdCurrency,
        array $extraData = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->balance = $balance;
        $this->currency = $currency;
        $this->type = $type;
        $this->primary = $primary;
        $this->active = $active;
        $this->extraData = $extraData;
        $this->availableOnConsumer = $availableOnConsumer;
        $this->holdBalance = $holdBalance;
        $this->holdCurrency = $holdCurrency;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isPrimary(): bool
    {
        return $this->primary;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function isAvailableOnConsumer(): bool
    {
        return $this->availableOnConsumer;
    }

    public function getHoldBalance(): float
    {
        return $this->holdBalance;
    }

    public function getHoldCurrency(): string
    {
        return $this->holdCurrency;
    }

    public function getExtraData(): array
    {
        return $this->extraData;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        $extraData = [];

        foreach ($array as $k => $value) {
            if (!in_array($k, self::FIELDS)) {
                $extraData[$k] = $value;
            }
        }

        return new static(
            $array['id'],
            $array['name'],
            $array['balance'],
            $array['currency'],
            $array['type'],
            $array['primary'],
            $array['active'],
            $array['available_on_consumer'],
            $array['hold_balance'],
            $array['hold_currency'],
            $extraData
        );
    }
}
