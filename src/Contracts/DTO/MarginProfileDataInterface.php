<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Class MarginProfileDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * {
 *   "profile_id": "8058d771-2d88-4f0f-ab6e-299c153d4308",
 *   "margin_initial_equity": "0.33",
 *   "margin_warning_equity": "0.2",
 *   "margin_call_equity": "0.15",
 *   "equity_percentage": 0.8725562096924747,
 *   "selling_power": 0.00221896,
 *   "buying_power": 23.51,
 *   "borrow_power": 23.51,
 *   "interest_rate": "0",
 *   "interest_paid": "0.3205913399694425",
 *   "collateral_currencies": [
 *     "BTC",
 *     "USD",
 *     "USDC"
 *   ],
 *   "collateral_hold_value": "1.0050000000000000",
 *   "last_liquidation_at": "2019-11-21T14:58:49.879Z",
 *   "available_borrow_limits": {
 *     "marginable_limit": 23.51,
 *     "nonmarginable_limit": 7.75
 *   },
 *   "borrow_limit": "5000",
 *   "top_up_amounts": {
 *     "borrowable_usd": "0",
 *     "non_borrowable_usd": "0"
 *   }
 * }
 */
interface MarginProfileDataInterface
{
}
