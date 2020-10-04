<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\UserAccount;

/**
 * @internal
 */
class UserAccountTest extends AbstractTest
{
    /**
     * @var UserAccount
     */
    private $userAccount;

    public function setUp(): void
    {
        parent::setUp();
        $this->userAccount = new UserAccount($this->requestManager);
    }

    public function testCreateNewReportRaw()
    {
        $raw = $this->userAccount->getTrailingVolumeRaw();

        self::assertStringContainsString('"product_id":', $raw);
        self::assertStringContainsString('"exchange_volume":', $raw);
        self::assertStringContainsString('"volume":', $raw);
        self::assertStringContainsString('"recorded_at":', $raw);
    }

    public function testGetReportStatus()
    {
        $volume = $this->userAccount->getTrailingVolume()[0];

        self::assertIsString($volume->getProductId());
        self::assertIsFloat($volume->getVolume());
        self::assertIsFloat($volume->getExchangeVolume());
        self::assertInstanceOf(DateTimeInterface::class, $volume->getRecordedAt());
    }
}
