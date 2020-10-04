<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

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
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return 'Is null or equal to expected value';
    }
}
