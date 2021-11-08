<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\CommonHelpers;

use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\CustomAsserts\AssertEmptyOrEquals;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\CustomAsserts\AssertEqualsOneOf;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\CustomAsserts\AssertIsNullOrIsString;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\CustomAsserts\AssertNullOrEquals;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\CustomAsserts\AssertNullOrInstanceOf;

trait TraitAssertMore
{
    public static function assertNullOrEquals($expected, $actual, string $message = '', float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = false, bool $ignoreCase = false): void
    {
        $constraint = new AssertNullOrEquals(
            $expected,
            $delta,
            $maxDepth,
            $canonicalize,
            $ignoreCase
        );

        static::assertThat($actual, $constraint, $message);
    }

    public static function assertNullOrInstanceOf(string $expected, $actual, string $message = ''): void
    {
        static::assertThat(
            $actual,
            new AssertNullOrInstanceOf($expected),
            $message
        );
    }

    public static function assertEmptyOrEquals($expected, $actual, string $message = '', float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = false, bool $ignoreCase = false): void
    {
        $constraint = new AssertEmptyOrEquals(
            $expected,
            $delta,
            $maxDepth,
            $canonicalize,
            $ignoreCase
        );

        static::assertThat($actual, $constraint, $message);
    }

    public static function assertEqualsOneOf(array $expected, $actual, string $message = ''): void
    {
        static::assertContains(
            $actual,
            $expected,
            $message
        );
    }

    public static function assertIsNullOrIsString($actual, string $message = ''): void
    {
        static::assertThat($actual, new AssertIsNullOrIsString(), $message);
    }
}
