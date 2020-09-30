<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\HoldData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ProfileData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\ReportData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\ReportData
 *
 * @internal
 */
class ReportDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "created_at": "2020-09-26T23:08:16.750086Z",
                    "completed_at": "2020-09-26T23:08:19.691Z",
                    "expires_at": "2020-10-03T23:08:16.750086Z",
                    "id": "ea359924-5635-46d3-8f54-313345ebc93c",
                    "type": "fills",
                    "status": "ready",
                    "user_id": "5e70d9c2371d9322ba7d99f5",
                    "file_url": "https:\/\/gdax-reports-sandbox.s3.amazonaws.com\/ea359924-5635-46d3-8f54-313345ebc93c\/fills.pdf?AWSAccessKeyId=AKIATE3ORIAXWAJD7GJJ&Expires=1601593699&Signature=3N6Cst3j6%2Bu8RFOlYJ0ZaNZef4E%3D",
                    "params": {
                        "start_date": "2019-09-26T23:08:16+0000",
                        "end_date": "2020-09-26T23:08:16+0000",
                        "format": "pdf",
                        "product_id": "BTC-USD",
                        "profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                        "user": {
                            "created_at": "2020-09-04T11:28:29.643947Z",
                            "active_at": "2020-09-04T11:28:29.667Z",
                            "id": "5e70d9c2371d9322ba7d99f5",
                            "name": "Marc Moreau",
                            "email": "moreau.marc.69@gmail.com",
                            "roles": null,
                            "is_banned": false,
                            "permissions": null,
                            "user_type": "business",
                            "fulfills_new_requirements": true,
                            "flags": null,
                            "details": null,
                            "default_profile_id": "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                            "oauth_client": "pro",
                            "preferences": {
                                "preferred_market": "BTC-USD",
                                "post_only_disabled": true,
                                "margin_joined_waitlist": "2020-09-07T20:29:25.897Z",
                                "margin_retail_promo_attempts": 3,
                                "margin_retail_web_promo_closed_in_utc": "2020-09-07T20:32:43.8090+00:00",
                                "mobile_app_discoverability_modal_closed_at_in_utc": "2020-09-04T11:42:54.8690+00:00"
                            },
                            "has_default": false,
                            "org_id": null,
                            "is_brokerage": false
                        },
                        "new_york_state": false
                    },
                    "file_count": null
                }',
            ],
            [
                '{
                    "id": "ea359924-5635-46d3-8f54-313345ebc93c",
                    "type": "fills",
                    "status": "pending"
                }'
            ]
        ];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var ReportData $reportData */
        $reportData = ReportData::createFromJson($json);
        self::assertInstanceOf(ReportData::class, $reportData);
        self::assertNullOrEquals(new \DateTime('2020-09-26T23:08:16.750086Z'), $reportData->getCreatedAt());
        self::assertNullOrEquals(new \DateTime('2020-09-26T23:08:19.691Z'), $reportData->getCompletedAt());
        self::assertNullOrEquals(new \DateTime('2020-10-03T23:08:16.750086Z'), $reportData->getExpiredAt());
        self::assertEquals('ea359924-5635-46d3-8f54-313345ebc93c', $reportData->getId());
        self::assertEquals('fills', $reportData->getType());
        self::assertEqualsOneOf(['pending', 'ready'], $reportData->getStatus());
//        self::assertEquals('', $reportData->getUserId());
        self::assertNullOrEquals('https://gdax-reports-sandbox.s3.amazonaws.com/ea359924-5635-46d3-8f54-313345ebc93c/fills.pdf?AWSAccessKeyId=AKIATE3ORIAXWAJD7GJJ&Expires=1601593699&Signature=3N6Cst3j6%2Bu8RFOlYJ0ZaNZef4E%3D', $reportData->getFileUrl());
        self::assertEmptyOrEquals([
            "start_date" => "2019-09-26T23:08:16+0000",
            "end_date" => "2020-09-26T23:08:16+0000",
            "format" => "pdf",
            "product_id" => "BTC-USD",
            "profile_id" => "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
            "user" => [
                "created_at" => "2020-09-04T11:28:29.643947Z",
                "active_at" => "2020-09-04T11:28:29.667Z",
                "id" => "5e70d9c2371d9322ba7d99f5",
                "name" => "Marc Moreau",
                "email" => "moreau.marc.69@gmail.com",
                "roles" => null,
                "is_banned" => false,
                "permissions" => null,
                "user_type" => "business",
                "fulfills_new_requirements" => true,
                "flags" => null,
                "details" => null,
                "default_profile_id" => "d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
                "oauth_client" => "pro",
                "preferences" => [
                    "preferred_market" => "BTC-USD",
                    "post_only_disabled" => true,
                    "margin_joined_waitlist" => "2020-09-07T20:29:25.897Z",
                    "margin_retail_promo_attempts" => 3,
                    "margin_retail_web_promo_closed_in_utc" => "2020-09-07T20:32:43.8090+00:00",
                    "mobile_app_discoverability_modal_closed_at_in_utc" => "2020-09-04T11:42:54.8690+00:00"
                ],
                "has_default" => false,
                "org_id" => null,
                "is_brokerage" => false
            ],
            "new_york_state" => false
        ], $reportData->getParams());
//        self::assertEquals('', $reportData->getFileCount());
    }
}
