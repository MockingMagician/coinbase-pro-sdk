<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Reports;

/**
 * @internal
 */
class ReportsTest extends AbstractTest
{
    /**
     * @var Reports
     */
    private $reports;

    /**
     * @var Accounts
     */
    private $accounts;

    public function setUp(): void
    {
        parent::setUp();
        $this->reports = new Reports($this->requestManager);
        $this->accounts = new Accounts($this->requestManager);
    }

    public function testCreateNewReportRaw()
    {
        $endDate = new \DateTime();
        $startDate = clone $endDate;
        $startDate->modify('-1 year');

        $raw = $this->reports->createNewReportRaw(
            Reports::TYPE_FILLS,
            $startDate,
            $endDate,
            'BTC-USD'
        );

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"status":', $raw);

        $accountId = null;
        $accounts = $this->accounts->list();
        foreach ($accounts as $account) {
            if ('USD' === $account->getCurrency()) {
                $accountId = $account->getId();
            }
        }

        $raw = $this->reports->createNewReportRaw(
            Reports::TYPE_ACCOUNT,
            $startDate,
            $endDate,
            null,
            $accountId
        );

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"status":', $raw);
    }

    public function testCreateNewReport()
    {
        $endDate = new \DateTime();
        $startDate = clone $endDate;
        $startDate->modify('-1 year');

        $report = $this->reports->createNewReport(
            Reports::TYPE_FILLS,
            $startDate,
            $endDate,
            'BTC-USD'
        );

        self::assertIsString($report->getId());
        self::assertIsString($report->getType());
        self::assertIsString($report->getStatus());
    }

    public function testGetReportStatusRaw()
    {
        $endDate = new \DateTime();
        $startDate = clone $endDate;
        $startDate->modify('-1 year');

        $report = $this->reports->createNewReport(
            Reports::TYPE_FILLS,
            $startDate,
            $endDate,
            'BTC-USD'
        );

        $raw = $this->reports->getReportStatusRaw($report->getId());

        self::assertStringContainsString('"created_at":', $raw);
        self::assertStringContainsString('"expires_at":', $raw);
        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"status":', $raw);
        self::assertStringContainsString('"user_id":', $raw);
        self::assertStringContainsString('"file_url":', $raw);
        self::assertStringContainsString('"params":', $raw);
    }

    public function testGetReportStatus()
    {
        $endDate = new \DateTime();
        $startDate = clone $endDate;
        $startDate->modify('-1 year');

        $report = $this->reports->createNewReport(
            Reports::TYPE_FILLS,
            $startDate,
            $endDate,
            'BTC-USD'
        );

        do {
            usleep(200000); // Waiting for report generation
            $report = $this->reports->getReportStatus($report->getId());
        } while ('ready' !== $report->getStatus());

        self::assertIsString($report->getId());
        self::assertIsString($report->getType());
        self::assertIsString($report->getStatus());
        self::assertInstanceOf(DateTimeInterface::class, $report->getCreatedAt());
        self::assertInstanceOf(DateTimeInterface::class, $report->getCompletedAt());
        self::assertInstanceOf(DateTimeInterface::class, $report->getExpiredAt());
        self::assertIsString($report->getFileUrl());
        self::assertIsArray($report->getParams());
        self::assertNotEmpty($report->getParams());
    }
}
