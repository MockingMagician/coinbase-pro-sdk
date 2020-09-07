<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsAmountDetailsDataInterface;

class PaymentMethodLimitsAmountDetailsData implements PaymentMethodLimitsAmountDetailsDataInterface
{
    /**
     * @var float
     */
    private $amount;
    /**
     * @var string
     */
    private $currency;

    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    public static function createFromArray(array $array)
    {
        return new self($array['amount'], $array['currency']);
    }
}
