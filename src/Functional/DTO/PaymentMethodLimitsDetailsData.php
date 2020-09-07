<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsAmountDetailsDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsDetailsDataInterface;

class PaymentMethodLimitsDetailsData implements PaymentMethodLimitsDetailsDataInterface
{
    /**
     * @var int
     */
    private $periodInDays;
    /**
     * @var PaymentMethodLimitsAmountDetailsDataInterface
     */
    private $total;
    /**
     * @var PaymentMethodLimitsAmountDetailsDataInterface
     */
    private $remaining;

    public function __construct(
        int $periodInDays,
        PaymentMethodLimitsAmountDetailsDataInterface $total,
        PaymentMethodLimitsAmountDetailsDataInterface $remaining
    ) {
        $this->periodInDays = $periodInDays;
        $this->total = $total;
        $this->remaining = $remaining;
    }

    /**
     * @return int
     */
    public function getPeriodInDays(): int
    {
        return $this->periodInDays;
    }

    /**
     * @return PaymentMethodLimitsAmountDetailsDataInterface
     */
    public function getTotal(): PaymentMethodLimitsAmountDetailsDataInterface
    {
        return $this->total;
    }

    /**
     * @return PaymentMethodLimitsAmountDetailsDataInterface
     */
    public function getRemaining(): PaymentMethodLimitsAmountDetailsDataInterface
    {
        return $this->remaining;
    }

    public static function createFromArray($array)
    {
        return new self(
            $array['period_in_days'],
            PaymentMethodLimitsAmountDetailsData::createFromArray($array['total']),
            PaymentMethodLimitsAmountDetailsData::createFromArray($array['remaining'])
        );
    }
}
