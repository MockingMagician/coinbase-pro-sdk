<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Currencies;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

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
        $raw = $this->currencies->listRaw();

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"name":', $raw);
        self::assertStringContainsString('"min_size":', $raw);
    }

    public function testGetCurrencies()
    {
        $currencies = $this->currencies->list();

        self::assertIsString($currencies[0]->getId());
        self::assertIsString($currencies[0]->getName());
        self::assertIsFloat($currencies[0]->getMinSize());
        self::assertIsArray($currencies[0]->getExtraData());
    }

    public function testGetOneCurrencyRaw()
    {
        $currencies = $this->currencies->list();

        foreach ($currencies as $currency) {
            try {
                $raw = $this->currencies->getCurrencyRaw($currency->getId());

                self::assertStringContainsString('"id":', $raw);
                self::assertStringContainsString('"name":', $raw);
                self::assertStringContainsString('"min_size":', $raw);
            } catch (ApiError $exception) {
                if ('NotFound' === $exception->getMessage()) {
                    continue;
                }
            }
        }
    }

    public function testGetOneCurrency()
    {
        $currencies = $this->currencies->list();

        foreach ($currencies as $currency) {
            try {
                $currency = $this->currencies->getCurrency($currency->getId());

                self::assertIsString($currency->getId());
                self::assertIsString($currency->getName());
                self::assertIsFloat($currency->getMinSize());
                self::assertIsArray($currency->getExtraData());
            } catch (ApiError $exception) {
                if ('NotFound' === $exception->getMessage()) {
                    continue;
                }
            }
        }
    }
}
