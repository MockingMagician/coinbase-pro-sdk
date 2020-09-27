<?php


namespace MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\CustomAsserts;


use PHPUnit\Framework\Constraint\IsInstanceOf;

class AssertNullOrInstanceOf extends IsInstanceOf
{
    protected function matches($other): bool
    {
        if (null === $other) {
            return true;
        }

        return parent::matches($other);
    }

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return 'Is null or instanceOf expected value';
    }
}
