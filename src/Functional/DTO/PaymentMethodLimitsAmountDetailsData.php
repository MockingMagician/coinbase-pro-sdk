<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsAmountDetailsDataInterface;

class PaymentMethodLimitsAmountDetailsData extends AbstractCreator implements PaymentMethodLimitsAmountDetailsDataInterface
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

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        return new self($array['amount'], $array['currency']);
    }
}
