<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Conversions;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;

/**
 * @internal
 */
class ConversionsTest extends AbstractTest
{
    use TraitAssertMore;
    /**
     * @var Conversions
     */
    private $conversions;

    public function setUp(): void
    {
        parent::setUp();
        $this->conversions = new Conversions($this->requestManager);
    }

    public function testConvertRaw()
    {
        $raw = $this->conversions->convertRaw('USD', 'USDC', 100);

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"amount":', $raw);
        self::assertStringContainsString('"from_account_id":', $raw);
        self::assertStringContainsString('"to_account_id":', $raw);
        self::assertStringContainsString('"from":', $raw);
        self::assertStringContainsString('"to":', $raw);
    }

    public function testConvert()
    {
        $conversion = $this->conversions->convert('USD', 'USDC', 100);

        self::assertIsString($conversion->getId());
        self::assertIsFloat($conversion->getAmount());
        self::assertIsString($conversion->getFrom());
        self::assertIsString($conversion->getTo());
        self::assertIsString($conversion->getFromAccountId());
        self::assertIsString($conversion->getToAccountId());
    }

    public function testGetConversionRaw()
    {
        $conversion = $this->conversions->convert('USDC', 'USD', 100);

        $raw = $this->conversions->getConversionRaw($conversion->getId());

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"amount":', $raw);
        self::assertStringContainsString('"from_account_id":', $raw);
        self::assertStringContainsString('"to_account_id":', $raw);
    }

    public function testGetConversion()
    {
        $conversion = $this->conversions->convert('USD', 'USDC', 100);

        $conversion = $this->conversions->getConversion($conversion->getId());

        self::assertIsString($conversion->getId());
        self::assertIsFloat($conversion->getAmount());
        self::assertIsNullOrIsString($conversion->getFrom());
        self::assertIsNullOrIsString($conversion->getTo());
        self::assertIsString($conversion->getFromAccountId());
        self::assertIsString($conversion->getToAccountId());
    }
}
