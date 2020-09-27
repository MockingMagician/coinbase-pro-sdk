<?php


namespace MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\CustomAsserts;


use PHPUnit\Framework\Constraint\IsEqual;

class AssertNullOrEquals extends IsEqual
{
    public function evaluate($other, $description = '', $returnResult = false)
    {
        if (null === $other) {
            return true;
        }

        return parent::evaluate($other, $description, $returnResult);
    }

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return 'Is null or equal to expected value';
    }
}
