<?php


namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;


use MockingMagician\CoinbaseProSdk\Functional\Connectivity\PaymentMethods;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Withdrawals;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class WithdrawalsTest extends AbstractTest
{
    /**
     * @var Withdrawals
     */
    private $withdrawals;
    /**
     * @var PaymentMethods
     */
    private $paymentMethods;

    public function setUp(): void
    {
        parent::setUp();
        $this->withdrawals = new Withdrawals($this->requestManager);
        $this->paymentMethods = new PaymentMethods($this->requestManager);
    }

    public function testListWithdrawalsRawTest()
    {
        $raw = $this->withdrawals->listWithdrawalsRaw();

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"completed_at":', $raw);
        self::assertStringContainsString('"processed_at":', $raw);
        self::assertStringContainsString('"canceled_at":', $raw);
        self::assertStringContainsString('"account_id":', $raw);
        self::assertStringContainsString('"user_id":', $raw);
        self::assertStringContainsString('"user_nonce":', $raw);
        self::assertStringContainsString('"amount":', $raw);
        self::assertStringContainsString('"details":', $raw);
    }

    public function testListWithdrawalsTest()
    {
        $withdrawals = $this->withdrawals->listWithdrawals();

        self::assertIsString($withdrawals[0]->getId());
        self::assertIsString($withdrawals[0]->getType());
        self::assertEquals('withdraw', $withdrawals[0]->getType());
        self::assertInstanceOf(\DateTimeImmutable::class, $withdrawals[0]->getCreatedAt());
        if (null !== $withdrawals[0]->getCompletedAt()) {
            self::assertInstanceOf(\DateTimeImmutable::class, $withdrawals[0]->getCompletedAt());
        }
        if (null !== $withdrawals[0]->getCanceledAt()) {
            self::assertInstanceOf(\DateTimeImmutable::class, $withdrawals[0]->getCanceledAt());
        }
        if (null !== $withdrawals[0]->getProcessedAt()) {
            self::assertInstanceOf(\DateTimeImmutable::class, $withdrawals[0]->getProcessedAt());
        }
        self::assertIsString($withdrawals[0]->getAccountId());
        self::assertIsString($withdrawals[0]->getUserId());
        self::assertTrue(is_int($withdrawals[0]->getUserNonce()) || is_null($withdrawals[0]->getUserNonce()));
        self::assertIsFloat($withdrawals[0]->getAmount());
        self::assertIsArray($withdrawals[0]->getDetails());
    }

    public function testGetWithdrawalRaw()
    {
        $withdrawals = $this->withdrawals->listWithdrawals();
        $raw = $this->withdrawals->getWithdrawalRaw($withdrawals[0]->getId());

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

    public function testGetWithdrawal()
    {
        $withdrawals = $this->withdrawals->listWithdrawals();
        $withdrawal = $this->withdrawals->getWithdrawal($withdrawals[0]->getId());

        self::assertIsString($withdrawal->getId());
        self::assertIsString($withdrawal->getType());
        self::assertEquals('withdraw', $withdrawal->getType());
        self::assertInstanceOf(\DateTimeImmutable::class, $withdrawal->getCreatedAt());
        if (null !== $withdrawal->getCompletedAt()) {
            self::assertInstanceOf(\DateTimeImmutable::class, $withdrawal->getCompletedAt());
        }
        if (null !== $withdrawal->getProcessedAt()) {
            self::assertInstanceOf(\DateTimeImmutable::class, $withdrawal->getProcessedAt());
        }
        self::assertIsString($withdrawal->getAccountId());
        self::assertIsString($withdrawal->getUserId());
        self::assertTrue(is_int($withdrawal->getUserNonce()) || is_null($withdrawal->getUserNonce()));
        self::assertIsFloat($withdrawal->getAmount());
        self::assertIsArray($withdrawal->getDetails());
    }

    public function testDoWithdrawRaw()
    {
        $paymentMethods = $this->paymentMethods->listPaymentMethods();
        foreach ($paymentMethods as $paymentMethod) {
            if ($paymentMethod->isAllowWithdraw()) {
                try {
                    $raw = $this->withdrawals->withdrawRaw(15, $paymentMethod->getCurrency(), $paymentMethod->getId());
                    self::assertStringContainsString('"id":', $raw);

                    break;
                } catch (ApiError $exception) {}
            }
        }
    }
}
