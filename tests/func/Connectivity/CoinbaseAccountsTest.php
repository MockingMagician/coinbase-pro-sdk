<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\CoinbaseAccounts;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;

/**
 * @internal
 */
class CoinbaseAccountsTest extends AbstractTest
{
    use TraitAssertMore;
    /**
     * @var CoinbaseAccounts
     */
    private $coinbaseAccounts;

    public function setUp(): void
    {
        parent::setUp();
        $this->coinbaseAccounts = new CoinbaseAccounts($this->requestManager);
    }

    public function testListRaw()
    {
        $raw = $this->coinbaseAccounts->listCoinbaseAccountsRaw();

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"name":', $raw);
        self::assertStringContainsString('"balance":', $raw);
        self::assertStringContainsString('"currency":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"primary":', $raw);
        self::assertStringContainsString('"active":', $raw);
    }

    public function testList()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->list();

        self::assertIsString($coinbaseAccounts[0]->getId());
        self::assertIsString($coinbaseAccounts[0]->getName());
        self::assertIsFloat($coinbaseAccounts[0]->getBalance());
        self::assertIsString($coinbaseAccounts[0]->getCurrency());
        self::assertIsString($coinbaseAccounts[0]->getType());
        self::assertIsBool($coinbaseAccounts[0]->isPrimary());
        self::assertIsBool($coinbaseAccounts[0]->isActive());
        self::assertIsArray($coinbaseAccounts[0]->getExtraData());
    }

    public function testGenerateCryptoAddressRaw()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->list();

        foreach ($coinbaseAccounts as $coinbaseAccount) {
            try {
                $raw = $this->coinbaseAccounts->generateCryptoAddressRaw($coinbaseAccount->getId());

                self::assertStringContainsString('"id":', $raw);
                self::assertStringContainsString('"address":', $raw);
                self::assertStringContainsString('"name":', $raw);
                self::assertStringContainsString('"callback_url":', $raw);
                self::assertStringContainsString('"created_at":', $raw);
                self::assertStringContainsString('"updated_at":', $raw);
                self::assertStringContainsString('"resource":', $raw);
                self::assertStringContainsString('"resource_path":', $raw);
                self::assertStringContainsString('"exchange_deposit_address":', $raw);
            } catch (ApiError $exception) {
                if ('Internal server error' === $exception->getMessage()
                    || false !== strpos($exception->getMessage(), 'Deposits are not allowed for this currency')
                ) {
                    continue;
                }

                throw $exception;
            }
        }
    }

    public function testGenerateCryptoAddress()
    {
        $coinbaseAccounts = $this->coinbaseAccounts->list();

        foreach ($coinbaseAccounts as $coinbaseAccount) {
            try {
                $address = $this->coinbaseAccounts->generateCryptoAddress($coinbaseAccount->getId());
                self::assertIsString($address->getId());
                self::assertIsString($address->getName());
                self::assertIsString($address->getAddress());
                self::assertIsNullOrIsString($address->getCallbackUrl());
                self::assertInstanceOf(\DateTimeImmutable::class, $address->getCreatedAt());
                self::assertInstanceOf(\DateTimeImmutable::class, $address->getUpdatedAt());
                self::assertIsNullOrIsString($address->getResource());
                self::assertIsNullOrIsString($address->getResourcePath());
                self::assertIsBool($address->isExchangeDepositAddress());
            } catch (ApiError $exception) {
                if ('Internal server error' === $exception->getMessage()
                    || false !== strpos($exception->getMessage(), 'Deposits are not allowed for this currency')
                ) {
                    continue;
                }

                throw $exception;
            }
        }
    }
}
