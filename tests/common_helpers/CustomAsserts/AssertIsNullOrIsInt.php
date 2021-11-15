<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\CustomAsserts;

use PHPUnit\Framework\Constraint\Constraint;

class AssertIsNullOrIsInt extends Constraint
{
    public function toString(): string
    {
        return 'if is null or an int';
    }

    protected function matches($other): bool
    {
        if (null === $other) {
            return true;
        }

        return is_int($other);
    }
}
