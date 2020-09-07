<?php


namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Deposits;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\PaymentMethods;

class DepositsTest extends AbstractTest
{
    /**
     * @var Deposits
     */
    private $deposits;
    /**
     * @var PaymentMethods
     */
    private $paymentMethods;

    public function setUp(): void
    {
        parent::setUp();
        $this->deposits = new Deposits($this->requestManager);
        $this->paymentMethods = new PaymentMethods($this->requestManager);
    }

    public function testListDepositsRaw()
    {
        $raw = $this->deposits->listDepositsRaw();

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"completed_at":', $raw);
        self::assertStringContainsString('"processed_at":', $raw);
        self::assertStringContainsString('"account_id":', $raw);
        self::assertStringContainsString('"user_id":', $raw);
        self::assertStringContainsString('"user_nonce":', $raw);
        self::assertStringContainsString('"amount":', $raw);
        self::assertStringContainsString('"details":', $raw);
    }

    public function testListDeposits()
    {
        $deposits = $this->deposits->listDeposits();

        self::assertIsString($deposits[0]->getId());
        self::assertIsString($deposits[0]->getType());
        self::assertEquals('deposit', $deposits[0]->getType());
        self::assertInstanceOf(\DateTimeImmutable::class, $deposits[0]->getCreatedAt());
        if ($deposits[0]->getCompletedAt() !== null) {
            self::assertInstanceOf(\DateTimeImmutable::class, $deposits[0]->getCompletedAt());
        }
        if ($deposits[0]->getProcessedAt() !== null) {
            self::assertInstanceOf(\DateTimeImmutable::class, $deposits[0]->getProcessedAt());
        }
        self::assertIsString($deposits[0]->getAccountId());
        self::assertIsString($deposits[0]->getUserId());
        self::assertTrue(is_int($deposits[0]->getUserNonce()) || is_null($deposits[0]->getUserNonce()));
        self::assertIsFloat($deposits[0]->getAmount());
        self::assertIsArray($deposits[0]->getDetails());
    }

    public function testGetDepositRaw()
    {
        $deposits = $this->deposits->listDeposits();
        $raw = $this->deposits->getDepositRaw($deposits[0]->getId());

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"completed_at":', $raw);
        self::assertStringContainsString('"processed_at":', $raw);
        self::assertStringContainsString('"account_id":', $raw);
        self::assertStringContainsString('"user_id":', $raw);
        self::assertStringContainsString('"user_nonce":', $raw);
        self::assertStringContainsString('"amount":', $raw);
        self::assertStringContainsString('"details":', $raw);
    }

    public function testGetDeposit()
    {
        $deposits = $this->deposits->listDeposits();
        $deposit = $this->deposits->getDeposit($deposits[0]->getId());

        self::assertIsString($deposit->getId());
        self::assertIsString($deposit->getType());
        self::assertEquals('deposit', $deposit->getType());
        self::assertInstanceOf(\DateTimeImmutable::class, $deposit->getCreatedAt());
        if ($deposit->getCompletedAt() !== null) {
            self::assertInstanceOf(\DateTimeImmutable::class, $deposit->getCompletedAt());
        }
        if ($deposit->getProcessedAt() !== null) {
            self::assertInstanceOf(\DateTimeImmutable::class, $deposit->getProcessedAt());
        }
        self::assertIsString($deposit->getAccountId());
        self::assertIsString($deposit->getUserId());
        self::assertTrue(is_int($deposit->getUserNonce()) || is_null($deposit->getUserNonce()));
        self::assertIsFloat($deposit->getAmount());
        self::assertIsArray($deposit->getDetails());
    }

    public function testDoDepositRaw()
    {
        $paymentMethods = $this->paymentMethods->listPaymentMethods();
        foreach ($paymentMethods as $paymentMethod) {
            foreach ($paymentMethod->getLimits()->getInstantBuy() as $paymentMethodLimitsDetailsData) {
                if ($paymentMethodLimitsDetailsData->getRemaining()->getAmount() > 15) {
                    $raw = $this->deposits->doDepositRaw(15, $paymentMethod->getCurrency(), $paymentMethod->getId());
                    self::assertStringContainsString('"id":', $raw);
                    break;
                }
            }
        }
    }
}
