<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;

use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\ReportDataInterface;

interface ReportsInterface
{
    const TYPE_FILLS = 'fills';
    const TYPE_ACCOUNT = 'account';
    const TYPES = [
        self::TYPE_FILLS,
        self::TYPE_ACCOUNT,
    ];

    const FORMAT_PDF = 'pdf';
    const FORMAT_CSV = 'csv';
    const FORMATS = [
        self::FORMAT_PDF,
        self::FORMAT_CSV,
    ];

    /**
     * Create a new report.
     *
     * Reports provide batches of historic information about your profile in various human and machine readable forms.
     *
     * HTTP REQUEST
     * POST /reports
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * PARAMETERS
     * Param    Description
     * type    fills or account
     * start_date    Starting date for the report (inclusive)
     * end_date    Ending date for the report (inclusive)
     * product_id    ID of the product to generate a fills report for. E.g. BTC-USD. Required if type is fills
     * account_id    ID of the account to generate an account report for. Required if type is account
     * format    pdf or csv (defualt is pdf)
     * email    Email address to send the report to (optional)
     *
     * The report will be generated when resources are available.
     * Report status can be queried via the /reports/:report_id endpoint.
     * The file_url field will be available once the report has successfully been created and is available for download.
     *
     * EXPIRED REPORTS
     * Reports are only available for download for a few days after being created.
     * Once a report expires, the report is no longer available for download and is deleted.
     */
    public function createNewReport(
        string $type,
        DateTimeInterface $startDate,
        DateTimeInterface $endDate,
        string $productId,
        string $accountId,
        string $format = self::FORMAT_PDF,
        string $email = null
    ): ReportDataInterface;

    /**
     * Get report status.
     *
     * HTTP REQUEST
     * GET /reports/:report_id
     *
     * Once a report request has been accepted for processing, the status is available by polling the report resource endpoint.
     * The final report will be uploaded and available at file_url once the status indicates ready
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * STATUS
     * Status    Description
     * pending    The report request has been accepted and is awaiting processing
     * creating    The report is being created
     * ready    The report is ready for download from file_url
     */
    public function getReportStatus(string $reportId): ReportDataInterface;
}
