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
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

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
        sleep(10); // let some time to remote server for treating in case of too much report
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

        try {
            $raw = $this->reports->createNewReportRaw(
                Reports::TYPE_ACCOUNT,
                $startDate,
                $endDate,
                null,
                $accountId
            );
        } catch (ApiError $apiError) {
            if ('User has too many reports currently running. Please try again later' === $apiError->getMessage()) {
                $this->markTestSkipped($apiError->getMessage());
            }
        }

        self::assertStringContainsString('"id":', $raw);
        self::assertStringContainsString('"type":', $raw);
        self::assertStringContainsString('"status":', $raw);
    }

    public function testCreateNewReport()
    {
        sleep(10); // let some time to remote server for treating in case of too much report
        $endDate = new \DateTime();
        $startDate = clone $endDate;
        $startDate->modify('-1 year');

        try {
            $report = $this->reports->createNewReport(
                Reports::TYPE_FILLS,
                $startDate,
                $endDate,
                'BTC-USD'
            );
        } catch (ApiError $apiError) {
            if ('User has too many reports currently running. Please try again later' === $apiError->getMessage()) {
                $this->markTestSkipped($apiError->getMessage());
            }
        }

        self::assertIsString($report->getId());
        self::assertIsString($report->getType());
        self::assertIsString($report->getStatus());
    }

    public function testGetReportStatusRaw()
    {
        sleep(10); // let some time to remote server for treating in case of too much report
        $endDate = new \DateTime();
        $startDate = clone $endDate;
        $startDate->modify('-1 year');

        try {
            $report = $this->reports->createNewReport(
                Reports::TYPE_FILLS,
                $startDate,
                $endDate,
                'BTC-USD'
            );
        } catch (ApiError $apiError) {
            if ('User has too many reports currently running. Please try again later' === $apiError->getMessage()) {
                $this->markTestSkipped($apiError->getMessage());
            }
        }

        do {
            usleep(200000); // Waiting for report generation
            $raw = $this->reports->getReportStatusRaw($report->getId());
            $raw = Json::decode($raw, true);
        } while ('ready' !== $raw['status'] ?? null);

        $raw = Json::encode($raw);

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
        sleep(10); // let some time to remote server for treating in case of too much report
        $endDate = new \DateTime();
        $startDate = clone $endDate;
        $startDate->modify('-1 year');

        try {
            $report = $this->reports->createNewReport(
                Reports::TYPE_FILLS,
                $startDate,
                $endDate,
                'BTC-USD'
            );
        } catch (ApiError $apiError) {
            if ('User has too many reports currently running. Please try again later' === $apiError->getMessage()) {
                $this->markTestSkipped($apiError->getMessage());
            }
        }

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
