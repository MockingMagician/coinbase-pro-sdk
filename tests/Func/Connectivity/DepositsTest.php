<?php


namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Deposits;

class DepositsTest extends AbstractTest
{
    /**
     * @var Deposits
     */
    private $deposits;

    public function setUp(): void
    {
        parent::setUp();
        $this->deposits = new Deposits($this->requestManager);
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
        self::assertIsInt($deposits[0]->getUserNonce());
        self::assertIsFloat($deposits[0]->getAmount());
        self::assertIsArray($deposits[0]->getDetails());
    }
}
