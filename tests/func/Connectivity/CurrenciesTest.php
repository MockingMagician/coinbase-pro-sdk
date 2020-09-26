<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Currencies;

/**
 * @internal
 */
class CurrenciesTest extends AbstractTest
{
    /**
     * @var Currencies
     */
    private $currencies;

    public function setUp(): void
    {
        parent::setUp();
        $this->currencies = new Currencies($this->requestManager);
    }

    public function testGetCurrenciesRaw()
    {
        $raw = $this->currencies->getCurrenciesRaw();

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"name":', $raw);
        self::assertStringContainsString('"min_size":', $raw);
    }

    public function testGetCurrencies()
    {
        $currencies = $this->currencies->getCurrencies();

        self::assertIsString($currencies[0]->getId());
        self::assertIsString($currencies[0]->getName());
        self::assertIsFloat($currencies[0]->getMinSize());
        self::assertIsArray($currencies[0]->getExtraData());
    }
}
