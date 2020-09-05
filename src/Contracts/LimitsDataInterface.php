<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;

/**
 * Class LimitDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts
 *
 * Lexical in use into json response
 *
 * ach = Automated Clearing House
 * An electronic funds transfer system allowing for the instantaneous transfer of money
 * between users for payroll deductions, tax refunds, direct deposits, and more transactions.
 * It is run by the National Automated Clearing House Association.
 *
 * {
 *   "limit_currency": "USD",
 *   "transfer_limits": {
 *     "ach": {
 *       "BAT": {
 *         "max": "21267.54245368",
 *         "remaining": "21267.54245368",
 *         "period_in_days": 7
 *       }
 *     },
 *     "ach_no_balance": {
 *       "BAT": {
 *         "max": "21267.54245368",
 *         "remaining": "21267.54245368",
 *         "period_in_days": 1
 *       }
 *     },
 *     "credit_debit_card": {
 *       "BAT": {
 *         "max": "1450.00481776",
 *         "remaining": "1450.00481776",
 *         "period_in_days": 7
 *       }
 *     },
 *     "ach_curm": {
 *       "BAT": {
 *         "max": "200748.99232287",
 *         "remaining": "200748.99232287",
 *         "period_in_days": 1
 *       }
 *     },
 *     "secure3d_buy": {
 *       "BAT": {
 *         "max": "1450.00481776",
 *         "remaining": "1450.00481776",
 *         "period_in_days": 7
 *       }
 *     },
 *     "exchange_withdraw": {
 *       "BAT": {
 *         "max": "220733.98464574",
 *         "remaining": "220733.98464574",
 *         "period_in_days": 1
 *       }
 *     },
 *     "exchange_ach": {
 *       "BAT": {
 *         "max": "21267.54245368",
 *         "remaining": "21267.54245368",
 *         "period_in_days": 7
 *       }
 *     },
 *     "paypal_withdrawal": {
 *       "BAT": {
 *         "max": "200748.99232287",
 *         "remaining": "200748.99232287",
 *         "period_in_days": 1
 *       }
 *     },
 *     "instant_ach_withdrawal": {
 *       "BAT": {
 *         "max": "1103.66992323",
 *         "remaining": "1103.66992323",
 *         "period_in_days": 1
 *       }
 *     },
 *     "buy": {
 *       "BAT": {
 *         "max": "212677.90003268",
 *         "remaining": "212677.90003268",
 *         "period_in_days": 7
 *       }
 *     },
 *     "sell": {
 *       "BAT": {
 *         "max": "212677.90003268",
 *         "remaining": "212677.90003268",
 *         "period_in_days": 7
 *       }
 *     }
 *   }
 * }
 */
class LimitsDataInterface
{

}
