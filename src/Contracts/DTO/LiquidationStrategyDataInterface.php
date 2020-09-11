<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface LiquidationStrategyDataInterface.
 *
 * {
 *   "id": "239f4dc6-72b6-11ea-b311-168e5016c449",
 *   "userId": "5cf6e115aaf44503db300f1e",
 *   "profileId": "8058d771-2d88-4f0f-ab6e-299c153d4308",
 *   "accountsList": [
 * {
 *   "id": "434e1152-8eb5-4bfa-89a1-92bb1dcaf0c3",
 *   "currency": "BTC",
 *   "amount": "0.00221897"
 * },
 * {
 *   "id": "6d326768-71f2-4068-99dc-7075c78f6402",
 *   "currency": "USD",
 *   "amount": "-1.9004458409934425"
 * },
 * {
 *   "id": "120c8fcf-94da-4b45-9c43-18f114880f7a",
 *   "currency": "USDC",
 *   "amount": "1.003328032382"
 * }
 * ],
 * "equityPercentage": "0.8744507743595747",
 * "totalAssetsUsd": "15.137057447382",
 * "totalLiabilitiesUsd": "1.9004458409934425",
 * "strategiesList": [
 * // {
 * //     "type": "",
 * //     "amount": "",
 * //     "product": "",
 * //     "strategy": "",
 * //     "accountId": "",
 * //     "orderId": ""
 * // }
 * ],
 * "createdAt": "2020-03-30 18:41:59.547863064 +0000 UTC m=+260120.906569441"
 * }
 */
interface LiquidationStrategyDataInterface
{
}
