<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ReportsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\ReportDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ReportData;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class Reports extends AbstractRequestManagerAware implements ReportsInterface
{
    public function createNewReportRaw(
        string $type,
        DateTimeInterface $startDate,
        DateTimeInterface $endDate,
        ?string $productId = null,
        ?string $accountId = null,
        string $format = self::FORMAT_PDF,
        ?string $email = null
    ) {
        if (!in_array($type, self::TYPES)) {
            throw new ApiError(sprintf('type must be one of : %s', implode(', ', self::TYPES)));
        }

        if (!in_array($format, self::FORMATS)) {
            throw new ApiError(sprintf('format must be one of : %s', implode(', ', self::FORMATS)));
        }

        $body = [
            'type' => $type,
            'start_date' => $startDate->format(DateTimeInterface::ISO8601),
            'end_date' => $endDate->format(DateTimeInterface::ISO8601),
            'format' => $format,
        ];

        if (self::TYPE_FILLS === $type && !$productId) {
            throw new ApiError('productId must be defined when type is fills');
        }

        if (self::TYPE_ACCOUNT === $type && !$accountId) {
            throw new ApiError('accountId must be defined when type is account');
        }

        if ($productId) {
            $body['product_id'] = $productId;
        }

        if ($accountId) {
            $body['account_id'] = $accountId;
        }

        if ($email) {
            $body['email'] = $email;
        }

        return $this->getRequestManager()->prepareRequest('POST', '/reports', [], json_encode($body))->signAndSend();
    }

    /**
     * {@inheritdoc}
     */
    public function createNewReport(
        string $type,
        DateTimeInterface $startDate,
        DateTimeInterface $endDate,
        ?string $productId = null,
        ?string $accountId = null,
        string $format = self::FORMAT_PDF,
        ?string $email = null
    ): ReportDataInterface {
        return ReportData::createFromJson($this->createNewReportRaw($type, $startDate, $endDate, $productId, $accountId, $format, $email));
    }

    public function getReportStatusRaw(string $reportId)
    {
        return $this->getRequestManager()->prepareRequest('GET', sprintf('/reports/%s', $reportId))->signAndSend();
    }

    /**
     * {@inheritdoc}
     */
    public function getReportStatus(string $reportId): ReportDataInterface
    {
        return ReportData::createFromJson($this->getReportStatusRaw($reportId));
    }
}
