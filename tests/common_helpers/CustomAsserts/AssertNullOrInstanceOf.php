<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\CustomAsserts;

use PHPUnit\Framework\Constraint\IsInstanceOf;

class AssertNullOrInstanceOf extends IsInstanceOf
{
    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return 'Is null or instanceOf expected value';
    }

    protected function matches($other): bool
    {
        if (null === $other) {
            return true;
        }

        return parent::matches($other);
    }
}
