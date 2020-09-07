<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsDetailsDataInterface;

class PaymentMethodLimitsData implements PaymentMethodLimitsDataInterface
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
     * @inheritDoc
     */
    public function getBuy(): array
    {
        return $this->buy;
    }

    /**
     * @inheritDoc
     */
    public function getInstantBuy(): array
    {
        return $this->instantBuy;
    }

    /**
     * @inheritDoc
     */
    public function getSell(): array
    {
        return $this->sell;
    }

    /**
     * @inheritDoc
     */
    public function getDeposit(): array
    {
        return $this->deposit;
    }

    public static function createFromArray($array)
    {
        $buy = [];
        foreach ($array['buy'] ?? [] as $value) {
            $buy[] = PaymentMethodLimitsDetailsData::createFromArray($value);
        }
        $instantBuy = [];
        foreach ($array['instant_buy'] ?? [] as $value) {
            $instantBuy[] = PaymentMethodLimitsDetailsData::createFromArray($value);
        }
        $sell = [];
        foreach ($array['sell'] ?? [] as $value) {
            $sell[] = PaymentMethodLimitsDetailsData::createFromArray($value);
        }
        $deposit = [];
        foreach ($array['deposit'] ?? [] as $value) {
            $deposit[] = PaymentMethodLimitsDetailsData::createFromArray($value);
        }

        return new self($buy, $instantBuy, $sell, $deposit);
    }
}