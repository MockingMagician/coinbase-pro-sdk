<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface LiquidationHistoryDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * {
 *   "event_id": "6d0edaf1-0c6f-11ea-a88c-0a04debd8c33",
 *   "event_time": "2019-11-21T14:58:49.879Z",
 *   "orders": [
 *     {
 *       "id": "6c8d0d4e-0c6f-11ea-947d-0a04debd8c33",
 *       "size": "0.02973507",
 *       "product_id": "BTC-USD",
 *       "profile_id": "8058d771-2d88-4f0f-ab6e-299c153d4308",
 *       "side": "sell",
 *       "type": "market",
 *       "post_only": false,
 *       "created_at": "2019-11-21 14:58:49.582305+00",
 *       "done_at": "2019-11-21 14:58:49.596+00",
 *       "done_reason": "filled",
 *       "fill_fees": "1.1529981537990000",
 *       "filled_size": "0.02973507",
 *       "executed_value": "230.5996307598000000",
 *       "status": "done",
 *       "settled": true
 *     }
 *   ]
 * }
 */
interface LiquidationHistoryDataInterface
{

}
