<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeImmutable;

/**
 * Class ReportDataInterface.
 *
 * Report in api doc
 *
 * }
 *   "id": "0428b97b-bec1-429e-a94c-59232926778d",
 *   "type": "fills",
 *   "status": "pending",
 *   "created_at": "2015-01-06T10:34:47.000Z",
 *   "completed_at": undefined,
 *   "expires_at": "2015-01-13T10:35:47.000Z",
 *   "file_url": undefined,
 *   "params": {
 *     "start_date": "2014-11-01T00:00:00.000Z",
 *     "end_date": "2014-11-30T23:59:59.000Z"
 *   }
 * }
 *
 * Returned by test api on creation request
 *
 * }
 *   "id": "0428b97b-bec1-429e-a94c-59232926778d",
 *   "type": "fills",
 *   "status": "pending"
 * }
 *
 * Returned by test api on get status
 *
 * {
 *     "created_at":"2020-09-12T20:19:07.157361Z",
 *     "expires_at":"2020-09-19T20:19:07.157361Z",
 *     "id":"318bdbb9-f558-4fcc-81b4-200dba739799",
 *     "type":"fills",
 *     "status":"creating",
 *     "user_id":"5e70d9c2371d9322ba7d99f5",
 *     "file_url":null,
 *     "params":{
 *         "start_date":"2019-09-12T20:19:06+0000",
 *         "end_date":"2020-09-12T20:19:06+0000",
 *         "format":"pdf","product_id":"BTC-USD",
 *         "profile_id":"d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
 *         "user":{
 *             "created_at":"2020-09-04T11:28:29.643947Z",
 *             "active_at":"2020-09-04T11:28:29.667Z",
 *             "id":"5e70d9c2371d9322ba7d99f5",
 *             "name":"Marc Moreau",
 *             "email":"moreau.marc.69@gmail.com",
 *             "roles":null,
 *             "is_banned":false,
 *             "permissions":null,
 *             "user_type":"business",
 *             "fulfills_new_requirements":true,
 *             "flags":null,
 *             "details":null,
 *             "default_profile_id":"d9313ff2-2ef2-4f4d-a310-65b5143fde3f",
 *             "oauth_client":"pro",
 *             "preferences":{
 *                  "preferred_market":"BTC-USD",
 *                  "post_only_disabled":true,
 *                  "margin_joined_waitlist":"2020-09-07T20:29:25.897Z",
 *                  "margin_retail_promo_attempts":3,
 *                  "margin_retail_web_promo_closed_in_utc":
 *                  "2020-09-07T20:32:43.8090+00:00",
 *                  "mobile_app_discoverability_modal_closed_at_in_utc":"2020-09-04T11:42:54.8690+00:00"
 *             },
 *             "has_default":false,
 *             "org_id":null,
 *             "is_brokerage":false
 *         },
 *         "new_york_state":false
 *     },
 *     "file_count":null
 * }
 *
 * another one
 *
 * {
 *     "created_at":"2020-09-12T20:36:38.381994Z",
 *     "completed_at":"2020-09-12T20:36:41.181Z",
 *     "expires_at":"2020-09-19T20:36:38.381994Z",
 *     "id":"54801738-33b5-494c-850a-d36d81fd8724",
 *     "type":"fills",
 *     "status":"ready",
 *     "user_id":"5e70d9c2371d9322ba7d99f5",
 *     "file_url":"https://gdax-reports-sandbox.s3.amazonaws.com/...",
 *     "params":{"start_date":"2019-09-12T20:36:37+0000", ... ,"new_york_state":false},
 *     "file_count":null
 * }
 *
 */
interface ReportDataInterface
{
    public function getId(): string;
    public function getType(): string;
    public function getStatus(): string;
    public function getCreatedAt(): ?DateTimeImmutable;
    public function getCompletedAt(): ?DateTimeImmutable;
    public function getExpiredAt(): ?DateTimeImmutable;
    public function getFileUrl(): ?string;
    public function getParams(): array;
}
