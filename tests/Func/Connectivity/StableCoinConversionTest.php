<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\PaymentMethods;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\StableCoinConversions;

/**
 * @internal
 * @coversNothing
 */
class StableCoinConversionTest extends AbstractTest
{
    /**
     * @var StableCoinConversions
     */
    private $stableCoinConversion;

    public function setUp(): void
    {
        parent::setUp();
        $this->stableCoinConversion = new StableCoinConversions($this->requestManager);
    }

    public function testListPaymentMethodsRaw()
    {
        $raw = $this->stableCoinConversion->createConversionRaw('USD', 'USDC', 15);

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"amount":', $raw);
        self::assertStringContainsString('"from_account_id":', $raw);
        self::assertStringContainsString('"to_account_id":', $raw);
        self::assertStringContainsString('"from":', $raw);
        self::assertStringContainsString('"to":', $raw);
    }

    public function testListPaymentMethods()
    {
        $conversion = $this->stableCoinConversion->createConversion('USDC', 'USD', 15);

        self::assertIsString($conversion->getId());
        self::assertIsString($conversion->getFromCurrencyId());
        self::assertIsString($conversion->getToCurrencyId());
        self::assertIsString($conversion->getFromAccountId());
        self::assertIsString($conversion->getToAccountId());
        self::assertIsFloat($conversion->getAmount());
    }
}
