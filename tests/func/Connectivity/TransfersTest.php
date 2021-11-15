<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use DateTimeImmutable;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PaymentMethodLimitsDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\CoinbaseAccounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Transfers;
use MockingMagician\CoinbaseProSdk\Functional\Enum\TransferTypeEnum;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;

/**
 * @internal
 */
class TransfersTest extends AbstractTest
{
    use TraitAssertMore;
    /**
     * @var Transfers
     */
    private $transfers;
    /**
     * @var CoinbaseAccounts
     */
    private $coinbaseAccounts;
    /**
     * @var Accounts
     */
    private $accounts;

    public function setUp(): void
    {
        parent::setUp();
        $this->transfers = new Transfers($this->requestManager);
        $this->coinbaseAccounts = new CoinbaseAccounts($this->requestManager);
        $this->accounts = new Accounts($this->requestManager);
    }

    public function testListPaymentMethodsRaw()
    {
        $raw = $this->transfers->listPaymentMethodsRaw();

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
        $paymentMethods = $this->transfers->listPaymentMethods();

        foreach ($paymentMethods as $paymentMethod) {
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

    public function testDepositFromCoinbaseRaw()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->list();
        $depositsDone = 0;
        foreach ($coinbaseAccounts as $ca) {
            try {
                $raw = $this->transfers->depositFromCoinbaseRaw(1000, $ca->getCurrency(), $ca->getId());
                self::assertStringContainsString('"id":', $raw);
                ++$depositsDone;
            } catch (\Throwable $e) {
            }
        }
        if (0 === $depositsDone) {
            $this->markTestSkipped('Data is missing for tests');
        }
    }

    public function testDoDepositCoinbase()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->list();
        $depositsDone = 0;
        foreach ($coinbaseAccounts as $ca) {
            try {
                $id = $this->transfers->depositFromCoinbase(5, $ca->getCurrency(), $ca->getId());
                self::assertIsString($id);
                ++$depositsDone;
            } catch (\Throwable $e) {
            }
        }
        if (0 === $depositsDone) {
            $this->markTestSkipped('Data is missing for tests');
        }
    }

    public function testDepositFromPaymentMethodRaw()
    {
        $paymentMethods = $this->transfers->listPaymentMethods();
        $depositsDone = 0;
        foreach ($paymentMethods as $paymentMethod) {
            foreach ($paymentMethod->getLimits()->getInstantBuy() as $paymentMethodLimitsDetailsData) {
                if ($paymentMethodLimitsDetailsData->getRemaining()->getAmount() > 15) {
                    try {
                        $raw = $this->transfers->depositFromPaymentMethodRaw(250, $paymentMethod->getCurrency(), $paymentMethod->getId());
                        self::assertStringContainsString('"id":', $raw);
                        ++$depositsDone;
                    } catch (\Throwable $exception) {
                    }
                }
            }
        }
        if (0 === $depositsDone) {
            $this->markTestSkipped('Data is missing for tests');
        }
    }

    public function testDepositFromPaymentMethod()
    {
        $paymentMethods = $this->transfers->listPaymentMethods();
        $depositsDone = 0;
        foreach ($paymentMethods as $paymentMethod) {
            foreach ($paymentMethod->getLimits()->getInstantBuy() as $paymentMethodLimitsDetailsData) {
                if ($paymentMethodLimitsDetailsData->getRemaining()->getAmount() > 15) {
                    try {
                        $id = $this->transfers->depositFromPaymentMethod(250, $paymentMethod->getCurrency(), $paymentMethod->getId());
                        self::assertIsString($id);
                        self::assertNotEmpty($id);
                        ++$depositsDone;
                    } catch (\Throwable $exception) {
                    }
                }
            }
        }
        if (0 === $depositsDone) {
            $this->markTestSkipped('Data is missing for tests');
        }
    }

    public function testGetTransferRaw()
    {
        $transferIds = [];

        $coinbaseAccounts = $this->coinbaseAccounts->list();
        foreach ($coinbaseAccounts as $ca) {
            try {
                $id = $this->transfers->depositFromCoinbase(5, $ca->getCurrency(), $ca->getId());
                $transferIds[] = $id;
            } catch (\Throwable $e) {
            }
        }

        $paymentMethods = $this->transfers->listPaymentMethods();
        foreach ($paymentMethods as $paymentMethod) {
            foreach ($paymentMethod->getLimits()->getInstantBuy() as $paymentMethodLimitsDetailsData) {
                if ($paymentMethodLimitsDetailsData->getRemaining()->getAmount() > 15) {
                    try {
                        $id = $this->transfers->depositFromPaymentMethod(250, $paymentMethod->getCurrency(), $paymentMethod->getId());
                        $transferIds[] = $id;
                    } catch (\Throwable $exception) {
                        continue;
                    }
                }
            }
        }

        foreach ($transferIds as $transferId) {
            $raw = $this->transfers->getTransferRaw($transferId);

            self::assertStringContainsString('"id":', $raw);
            self::assertStringContainsString('"type":', $raw);
            self::assertStringContainsString('"created_at":', $raw);
            self::assertStringContainsString('"completed_at":', $raw);
            self::assertStringContainsString('"canceled_at":', $raw);
            self::assertStringContainsString('"processed_at":', $raw);
            self::assertStringContainsString('"account_id":', $raw);
            self::assertStringContainsString('"user_id":', $raw);
            self::assertStringContainsString('"user_nonce":', $raw);
            self::assertStringContainsString('"amount":', $raw);
            self::assertStringContainsString('"details":', $raw);
            self::assertStringContainsString('"idem":', $raw);
        }
    }

    public function testGetTransfer()
    {
        $transferIds = [];

        $coinbaseAccounts = $this->coinbaseAccounts->list();
        foreach ($coinbaseAccounts as $ca) {
            try {
                $id = $this->transfers->depositFromCoinbase(5, $ca->getCurrency(), $ca->getId());
                $transferIds[] = $id;
            } catch (\Throwable $e) {
            }
        }

        $paymentMethods = $this->transfers->listPaymentMethods();
        foreach ($paymentMethods as $paymentMethod) {
            foreach ($paymentMethod->getLimits()->getInstantBuy() as $paymentMethodLimitsDetailsData) {
                if ($paymentMethodLimitsDetailsData->getRemaining()->getAmount() > 15) {
                    try {
                        $id = $this->transfers->depositFromPaymentMethod(250, $paymentMethod->getCurrency(), $paymentMethod->getId());
                        $transferIds[] = $id;
                    } catch (\Throwable $exception) {
                        continue;
                    }
                }
            }
        }

        foreach ($transferIds as $transferId) {
            $transfer = $this->transfers->getTransfer($transferId);

            self::assertIsString($transfer->getId());
            self::assertIsFloat($transfer->getAmount());
            self::assertIsString($transfer->getType());
            self::assertNullOrInstanceOf(DateTimeImmutable::class, $transfer->getCreatedAt());
            self::assertNullOrInstanceOf(DateTimeImmutable::class, $transfer->getProcessedAt());
            self::assertNullOrInstanceOf(DateTimeImmutable::class, $transfer->getCompletedAt());
            self::assertNullOrInstanceOf(DateTimeImmutable::class, $transfer->getCanceledAt());
            self::assertIsNullOrIsInt($transfer->getUserNonce());
            self::assertIsNullOrIsString($transfer->getIdem());
            self::assertIsNullOrIsString($transfer->getUserId());
            self::assertIsNullOrIsString($transfer->getAccountId());
            self::assertIsNullOrIsString($transfer->getIdem());
            self::assertIsArray($transfer->getDetails());
        }
    }

    public function testWithdrawCoinbaseRaw()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->list();
        $withdrawalDone = 0;
        foreach ($coinbaseAccounts as $ca) {
            try {
                $raw = $this->transfers->withdrawToCoinbaseRaw(1, $ca->getCurrency(), $ca->getId());
                self::assertStringContainsString('"id":', $raw);
                ++$withdrawalDone;
            } catch (ApiError $e) {
            }
        }
        if (0 === $withdrawalDone) {
            $this->markTestSkipped('Data is missing for tests');
        }
    }

    public function testWithdrawCoinbase()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->list();
        $withdrawalDone = 0;
        foreach ($coinbaseAccounts as $ca) {
            try {
                $id = $this->transfers->withdrawToCoinbase(1, $ca->getCurrency(), $ca->getId());
                self::assertIsString($id);
                self::assertNotEmpty($id);
                ++$withdrawalDone;
            } catch (ApiError $e) {
            }
        }
        if (0 === $withdrawalDone) {
            $this->markTestSkipped('Data is missing for tests');
        }
    }

    public function provideWalletAddresses()
    {
        $addresses = [
            'BTC' => '1NxzVB5kYNeEoxGW34VZERNkS1Pk7CvHQE',
            'BAT' => '0x69a59b1c1887A78A0Dbf20AD03d16A13c21597d0',
            'ETH' => '0x47dd311b04EfF1f1d9bfb0968Cbe1b8f6D457aA6',
            'LINK' => '0x689a8A3c2b05815162c2b562e9cA0504c111f93d',
        ];

        return [[$addresses]];
    }

    /**
     * @dataProvider provideWalletAddresses
     */
    public function testWithdrawToCryptoAddressRaw(array $addresses)
    {
        $accounts = $this->accounts->list();
        $transfersDone = 0;
        foreach ($accounts as $account) {
            if (!key_exists($account->getCurrency(), $addresses)) {
                continue;
            }

            $address = $addresses[$account->getCurrency()];

            try {
                $raw = $this->transfers->withdrawToCryptoAddressRaw(1, $account->getCurrency(), $address);
                self::assertStringContainsString('"id":', $raw);
                ++$transfersDone;
            } catch (ApiError $exception) {
                if ('ServiceUnavailable' === $exception->getMessage()) {
                    continue;
                }

                throw $exception;
            }
        }
        if (0 === $transfersDone) {
            $this->markTestSkipped('Unable to test in API test environment (service unavailable)');
        }
    }

    /**
     * @dataProvider provideWalletAddresses
     */
    public function testWithdrawToCryptoAddress(array $addresses)
    {
        $accounts = $this->accounts->list();
        $transfersDone = 0;
        foreach ($accounts as $account) {
            if (!key_exists($account->getCurrency(), $addresses)) {
                continue;
            }

            $address = $addresses[$account->getCurrency()];

            try {
                $id = $this->transfers->withdrawToCryptoAddress(1, $account->getCurrency(), $address);
                self::assertIsString($id);
                self::assertNotEmpty($id);
                ++$transfersDone;
            } catch (ApiError $exception) {
                if ('ServiceUnavailable' === $exception->getMessage()) {
                    continue;
                }

                throw $exception;
            }
        }
        if (0 === $transfersDone) {
            $this->markTestSkipped('Unable to test in API test environment (service unavailable)');
        }
    }

    /**
     * @dataProvider provideWalletAddresses
     */
    public function testGetFeeEstimateRaw(array $addresses)
    {
        $accounts = $this->accounts->list();
        $getFeeEstimates = 0;
        foreach ($accounts as $account) {
            if (!key_exists($account->getCurrency(), $addresses)) {
                continue;
            }

            $address = $addresses[$account->getCurrency()];

            try {
                $raw = $this->transfers->getFeeEstimateRaw($account->getCurrency(), $address);
                self::assertStringContainsString('"fee":', $raw);
                ++$getFeeEstimates;
            } catch (ApiError $exception) {
                dump($exception);
            }
        }

        if (0 === $getFeeEstimates) {
            $this->markTestSkipped('Unable to test in API test environment (service unavailable)');
        }
    }

    /**
     * @dataProvider provideWalletAddresses
     */
    public function testGetFeeEstimate(array $addresses)
    {
        $accounts = $this->accounts->list();
        $getFeeEstimates = 0;
        foreach ($accounts as $account) {
            if (!key_exists($account->getCurrency(), $addresses)) {
                continue;
            }

            $address = $addresses[$account->getCurrency()];

            try {
                $fee = $this->transfers->getFeeEstimate($account->getCurrency(), $address);
                self::assertIsFloat($fee);
                ++$getFeeEstimates;
            } catch (ApiError $exception) {
            }
        }

        if (0 === $getFeeEstimates) {
            $this->markTestSkipped('Unable to test in API test environment (service unavailable)');
        }
    }

    public function testWithdrawToPaymentMethodRaw()
    {
        $paymentMethods = $this->transfers->listPaymentMethods();
        $withdrawalDone = 0;
        foreach ($paymentMethods as $paymentMethod) {
            if ($paymentMethod->isAllowWithdraw()) {
                try {
                    $raw = $this->transfers->withdrawToPaymentMethodRaw(15, $paymentMethod->getCurrency(), $paymentMethod->getId());
                    self::assertStringContainsString('"id":', $raw);
                    ++$withdrawalDone;
                } catch (ApiError $exception) {
                }
            }
        }
        if (0 === $withdrawalDone) {
            $this->markTestSkipped('Data is missing for tests');
        }
    }

    public function testWithdrawToPaymentMethod()
    {
        $paymentMethods = $this->transfers->listPaymentMethods();
        $withdrawalDone = 0;
        foreach ($paymentMethods as $paymentMethod) {
            if ($paymentMethod->isAllowWithdraw()) {
                try {
                    $id = $this->transfers->withdrawToPaymentMethod(15, $paymentMethod->getCurrency(), $paymentMethod->getId());
                    self::assertIsString($id);
                    self::assertNotEmpty($id);
                    ++$withdrawalDone;
                } catch (ApiError $exception) {
                }
            }
        }
        if (0 === $withdrawalDone) {
            $this->markTestSkipped('Data is missing for tests');
        }
    }

    public function testListTransfersRaw()
    {
        $raw = $this->transfers->listTransfersRaw();

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"completed_at":', $raw);
        self::assertStringContainsString('"canceled_at":', $raw);
        self::assertStringContainsString('"processed_at":', $raw);
        self::assertStringContainsString('"account_id":', $raw);
        self::assertStringContainsString('"user_id":', $raw);
        self::assertStringContainsString('"user_nonce":', $raw);
        self::assertStringContainsString('"amount":', $raw);
        self::assertStringContainsString('"details":', $raw);
        self::assertStringContainsString('"idem":', $raw);
    }

    public function testListTransfers()
    {
        $transfers = $this->transfers->listTransfers();

        foreach ($transfers as $transfer) {
            self::assertIsString($transfer->getId());
            self::assertIsFloat($transfer->getAmount());
            self::assertIsString($transfer->getType());
            self::assertNullOrInstanceOf(DateTimeImmutable::class, $transfer->getCreatedAt());
            self::assertNullOrInstanceOf(DateTimeImmutable::class, $transfer->getProcessedAt());
            self::assertNullOrInstanceOf(DateTimeImmutable::class, $transfer->getCompletedAt());
            self::assertNullOrInstanceOf(DateTimeImmutable::class, $transfer->getCanceledAt());
            self::assertIsNullOrIsInt($transfer->getUserNonce());
            self::assertIsNullOrIsString($transfer->getIdem());
            self::assertIsArray($transfer->getDetails());
        }
    }

    public function testListTransfersTyped()
    {
        $transfers = $this->transfers->listTransfers(TransferTypeEnum::deposit());

        foreach ($transfers as $transfer) {
            self::assertIsString($transfer->getType());
            self::assertEquals(TransferTypeEnum::deposit()->value, $transfer->getType());
        }

        $transfers = $this->transfers->listTransfers(TransferTypeEnum::withdraw());

        foreach ($transfers as $transfer) {
            self::assertIsString($transfer->getType());
            self::assertEquals(TransferTypeEnum::withdraw()->value, $transfer->getType());
        }
    }
}
