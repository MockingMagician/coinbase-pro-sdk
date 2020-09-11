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

/**
 * @internal
 * @coversNothing
 */
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
    /**
     * @var CoinbaseAccounts
     */
    private $coinbaseAccounts;

    public function setUp(): void
    {
        parent::setUp();
        $this->deposits = new Deposits($this->requestManager);
        $this->paymentMethods = new PaymentMethods($this->requestManager);
        $this->coinbaseAccounts = new CoinbaseAccounts($this->requestManager);
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
        if (null !== $deposits[0]->getCompletedAt()) {
            self::assertInstanceOf(\DateTimeImmutable::class, $deposits[0]->getCompletedAt());
        }
        if (null !== $deposits[0]->getProcessedAt()) {
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
        if (null !== $deposit->getCompletedAt()) {
            self::assertInstanceOf(\DateTimeImmutable::class, $deposit->getCompletedAt());
        }
        if (null !== $deposit->getProcessedAt()) {
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

    public function testDoDeposit()
    {
        $paymentMethods = $this->paymentMethods->listPaymentMethods();
        foreach ($paymentMethods as $paymentMethod) {
            foreach ($paymentMethod->getLimits()->getInstantBuy() as $paymentMethodLimitsDetailsData) {
                if ($paymentMethodLimitsDetailsData->getRemaining()->getAmount() > 15) {
                    $id = $this->deposits->doDeposit(15, $paymentMethod->getCurrency(), $paymentMethod->getId());
                    self::assertIsString($id);

                    break;
                }
            }
        }
    }

    public function testDoDepositCoinbaseRaw()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->listCoinbaseAccounts();
        foreach ($coinbaseAccounts as $ca) {
            try {
                $raw = $this->deposits->doDepositFromCoinbaseRaw(5, $ca->getCurrency(), $ca->getId());
                self::assertStringContainsString('"id":', $raw);
            } catch (\Throwable $e) {
            }
        }
    }

    public function testDoDepositCoinbase()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->listCoinbaseAccounts();
        foreach ($coinbaseAccounts as $ca) {
            try {
                $id = $this->deposits->doDepositFromCoinbase(5, $ca->getCurrency(), $ca->getId());
                self::assertIsString($id);
            } catch (\Throwable $e) {
            }
        }
    }

    public function testGenerateCryptoDepositAddressRaw()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->listCoinbaseAccounts();
        $raw = $this->deposits->generateCryptoDepositAddressRaw($coinbaseAccounts[0]->getId());

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"address":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"updated_at":', $raw);
        self::assertStringContainsString('"resource":', $raw);
        self::assertStringContainsString('"exchange_deposit_address":', $raw);
    }

    public function testGenerateCryptoDepositAddress()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->listCoinbaseAccounts();
        $cryptoAddress = $this->deposits->generateCryptoDepositAddress($coinbaseAccounts[0]->getId());

        self::assertIsString($cryptoAddress->getId());
        self::assertIsString($cryptoAddress->getAddress());
        self::assertInstanceOf(\DateTimeInterface::class, $cryptoAddress->getCreatedAt());
        self::assertInstanceOf(\DateTimeInterface::class, $cryptoAddress->getUpdatedAt());
        self::assertIsString($cryptoAddress->getResource());
        self::assertIsBool($cryptoAddress->isExchangeDepositAddress());
    }
}
