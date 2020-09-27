<?php


namespace MockingMagician\CoinbaseProSdk\Tests\CommonHelpers;


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
}
