<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\PaymentMethods;

/**
 * @internal
 * @coversNothing
 */
class PaymentMethodsTest extends AbstractTest
{
    /**
     * @var PaymentMethods
     */
    private $paymentMethods;

    public function setUp(): void
    {
        parent::setUp();
        $this->paymentMethods = new PaymentMethods($this->requestManager);
    }

    public function testListPaymentMethodsRaw()
    {
        $raw = $this->paymentMethods->listPaymentMethodsRaw();

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"name":', $raw);
        self::assertStringContainsString('"currency":', $raw);
        self::assertStringContainsString('"primary_buy":', $raw);
        self::assertStringContainsString('"primary_sell":', $raw);
        self::assertStringContainsString('"allow_buy":', $raw);
        self::assertStringContainsString('"allow_sell":', $raw);
        self::assertStringContainsString('"allow_deposit":', $raw);
        self::assertStringContainsString('"allow_withdraw":', $raw);
        self::assertStringContainsString('"limits":', $raw);
    }

    public function testListPaymentMethods()
    {
        $paymentMethod = $this->paymentMethods->listPaymentMethods()[0];

        self::assertIsString($paymentMethod->getId());
        self::assertIsString($paymentMethod->getType());
        self::assertIsString($paymentMethod->getName());
        self::assertIsString($paymentMethod->getCurrency());
        self::assertInstanceOf(PaymentMethodLimitsDataInterface::class, $paymentMethod->getLimits());
        self::assertIsBool($paymentMethod->isAllowSell());
        self::assertIsBool($paymentMethod->isAllowBuy());
        self::assertIsBool($paymentMethod->isAllowDeposit());
        self::assertIsBool($paymentMethod->isAllowWithdraw());
        self::assertIsBool($paymentMethod->isPrimaryBuy());
        self::assertIsBool($paymentMethod->isPrimarySell());
    }
}
