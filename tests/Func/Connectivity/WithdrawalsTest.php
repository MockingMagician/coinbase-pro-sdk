<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\CoinbaseAccounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Deposits;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\PaymentMethods;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Withdrawals;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

/**
 * @internal
 */
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
    /**
     * @var CoinbaseAccounts
     */
    private $coinbaseAccounts;
    /**
     * @var Deposits
     */
    private $deposits;

    public function setUp(): void
    {
        parent::setUp();
        $this->withdrawals = new Withdrawals($this->requestManager);
        $this->paymentMethods = new PaymentMethods($this->requestManager);
        $this->coinbaseAccounts = new CoinbaseAccounts($this->requestManager);
        $this->deposits = new Deposits($this->requestManager);
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
                    $raw = $this->withdrawals->doWithdrawRaw(15, $paymentMethod->getCurrency(), $paymentMethod->getId());
                    self::assertStringContainsString('"id":', $raw);

                    break;
                } catch (ApiError $exception) {
                }
            }
        }
    }

    public function testDoWithdraw()
    {
        $paymentMethods = $this->paymentMethods->listPaymentMethods();
        foreach ($paymentMethods as $paymentMethod) {
            if ($paymentMethod->isAllowWithdraw()) {
                try {
                    $id = $this->withdrawals->doWithdraw(15, $paymentMethod->getCurrency(), $paymentMethod->getId());
                    self::assertIsString($id);
                    self::assertNotEmpty($id);

                    break;
                } catch (ApiError $exception) {
                }
            }
        }
    }

    public function testDoWithdrawCoinbaseRaw()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->listCoinbaseAccounts();
        foreach ($coinbaseAccounts as $ca) {
            try {
                $raw = $this->withdrawals->doWithdrawToCoinbaseRaw(5, $ca->getCurrency(), $ca->getId());
                self::assertStringContainsString('"id":', $raw);

                break;
            } catch (\Throwable $e) {
            }
        }
    }

    public function testDoWithdrawCoinbase()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->listCoinbaseAccounts();
        foreach ($coinbaseAccounts as $ca) {
            try {
                $id = $this->withdrawals->doWithdrawToCoinbase(5, $ca->getCurrency(), $ca->getId());
                self::assertIsString($id);
                self::assertNotEmpty($id);

                break;
            } catch (\Throwable $e) {
            }
        }
    }

    public function testDoWithdrawToCryptoAddressRaw()
    {
        $this->markTestSkipped(
            'Impossible to test in api test'
        );
        $this->withdrawals->doWithdrawToCryptoAddressRaw(5, 'BTC', 'bc1q6m6j6m970gedw68rhzjcj437lquyhh2tzptahw');
    }

    public function testDoWithdrawToCryptoAddress()
    {
        $this->markTestSkipped(
            'Impossible to test in api test'
        );
        $this->withdrawals->doWithdrawToCryptoAddress(5, 'BTC', 'bc1q6m6j6m970gedw68rhzjcj437lquyhh2tzptahw');
    }
}
