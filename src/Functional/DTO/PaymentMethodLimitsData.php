<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsDetailsDataInterface;

class PaymentMethodLimitsData extends AbstractCreator implements PaymentMethodLimitsDataInterface
{
    /**
     * @var PaymentMethodLimitsDetailsDataInterface[]
     */
    private $buy;
    /**
     * @var PaymentMethodLimitsDetailsDataInterface[]
     */
    private $instantBuy;
    /**
     * @var PaymentMethodLimitsDetailsDataInterface[]
     */
    private $sell;
    /**
     * @var PaymentMethodLimitsDetailsDataInterface[]
     */
    private $deposit;

    public function __construct(
        array $buy,
        array $instantBuy,
        array $sell,
        array $deposit
    ) {
        $this->buy = $buy;
        $this->instantBuy = $instantBuy;
        $this->sell = $sell;
        $this->deposit = $deposit;
    }

    /**
     * {@inheritdoc}
     */
    public function getBuy(): array
    {
        return $this->buy;
    }

    /**
     * {@inheritdoc}
     */
    public function getInstantBuy(): array
    {
        return $this->instantBuy;
    }

    /**
     * {@inheritdoc}
     */
    public function getSell(): array
    {
        return $this->sell;
    }

    /**
     * {@inheritdoc}
     */
    public function getDeposit(): array
    {
        return $this->deposit;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        $buy = [];
        foreach ($array['buy'] ?? [] as $value) {
            $buy[] = PaymentMethodLimitsDetailsData::createFromArray($value, $divers);
        }
        $instantBuy = [];
        foreach ($array['instant_buy'] ?? [] as $value) {
            $instantBuy[] = PaymentMethodLimitsDetailsData::createFromArray($value, $divers);
        }
        $sell = [];
        foreach ($array['sell'] ?? [] as $value) {
            $sell[] = PaymentMethodLimitsDetailsData::createFromArray($value, $divers);
        }
        $deposit = [];
        foreach ($array['deposit'] ?? [] as $value) {
            $deposit[] = PaymentMethodLimitsDetailsData::createFromArray($value, $divers);
        }

        return new static($buy, $instantBuy, $sell, $deposit);
    }
}
