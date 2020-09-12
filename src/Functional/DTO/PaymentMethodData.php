<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsDataInterface;

class PaymentMethodData extends AbstractCreator implements PaymentMethodDataInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var bool
     */
    private $primary_buy;
    /**
     * @var bool
     */
    private $primary_sell;
    /**
     * @var bool
     */
    private $allow_buy;
    /**
     * @var bool
     */
    private $allow_sell;
    /**
     * @var bool
     */
    private $allow_deposit;
    /**
     * @var bool
     */
    private $allow_withdraw;
    /**
     * @var PaymentMethodLimitsDataInterface
     */
    private $limits;

    public function __construct(
        string $id,
        string $type,
        string $name,
        string $currency,
        bool $primary_buy,
        bool $primary_sell,
        bool $allow_buy,
        bool $allow_sell,
        bool $allow_deposit,
        bool $allow_withdraw,
        PaymentMethodLimitsDataInterface $limits
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->currency = $currency;
        $this->primary_buy = $primary_buy;
        $this->primary_sell = $primary_sell;
        $this->allow_buy = $allow_buy;
        $this->allow_sell = $allow_sell;
        $this->allow_deposit = $allow_deposit;
        $this->allow_withdraw = $allow_withdraw;
        $this->limits = $limits;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function isPrimaryBuy(): bool
    {
        return $this->primary_buy;
    }

    public function isPrimarySell(): bool
    {
        return $this->primary_sell;
    }

    public function isAllowBuy(): bool
    {
        return $this->allow_buy;
    }

    public function isAllowSell(): bool
    {
        return $this->allow_sell;
    }

    public function isAllowDeposit(): bool
    {
        return $this->allow_deposit;
    }

    public function isAllowWithdraw(): bool
    {
        return $this->allow_withdraw;
    }

    public function getLimits(): PaymentMethodLimitsDataInterface
    {
        return $this->limits;
    }

    public static function createCollectionFromJson(string $json, ...$divers): array
    {
        $collection = json_decode($json, true);
        foreach ($collection as $k => $value) {
            $collection[$k] = new PaymentMethodData(
                $value['id'],
                $value['type'],
                $value['name'],
                $value['currency'],
                $value['primary_buy'],
                $value['primary_sell'],
                $value['allow_buy'],
                $value['allow_sell'],
                $value['allow_deposit'],
                $value['allow_withdraw'],
                PaymentMethodLimitsData::createFromArray($value['limits'])
            );
        }

        return $collection;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        // TODO: Implement createFromArray() method.
    }
}
