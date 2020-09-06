<?php


namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;


use MockingMagician\CoinbaseProSdk\Functional\Connectivity\CoinbaseAccounts;

class CoinbaseAccountsTest extends AbstractTest
{
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
        $coinbaseAccounts = $this->coinbaseAccounts->listCoinbaseAccounts();

        self::assertIsString($coinbaseAccounts[0]->getId());
        self::assertIsString($coinbaseAccounts[0]->getName());
        self::assertIsFloat($coinbaseAccounts[0]->getBalance());
        self::assertIsString($coinbaseAccounts[0]->getCurrency());
        self::assertIsString($coinbaseAccounts[0]->getType());
        self::assertIsBool($coinbaseAccounts[0]->isPrimary());
        self::assertIsBool($coinbaseAccounts[0]->isActive());
        self::assertIsArray($coinbaseAccounts[0]->getExtraData());
    }
}
