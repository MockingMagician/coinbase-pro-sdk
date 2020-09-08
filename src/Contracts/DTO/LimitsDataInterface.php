<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

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
 * Example in api docs :
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
 *
 * Returned by api test :
 *
 * {
 *      limit_currency":"USD",
 *      transfer_limits": {
 *          "ach":{
 *              "USD":{
 *                  "max":50,
 *                  "remaining":25
 *              },
 *              "EUR":{
 *                  "max":45.48,
 *                  "remaining":22.74
 *              },
 *              "GBP":{
 *                  "max":32.64,
 *                  "remaining":16.32
 *              },
 *              "CAD":{"max":65.8,"remaining":32.9}
 *          },
 *          "instant_buy":{
 *              "USD":{"max":0,"remaining":0},
 *              "EUR":{"max":0,"remaining":0},
 *              "GBP":{"max":0,"remaining":0},
 *              "CAD":{"max":0,"remaining":0}
 *          },
 *          "secure3d_buy":{
 *              "USD":{"max":0,"remaining":0},
 *              "EUR":{"max":0,"remaining":0},
 *              "GBP":{"max":0,"remaining":0},
 *              "CAD":{"max":0,"remaining":0}
 *          },
 *          "buy":{
 *              "USD":{"max":3000,"remaining":3000},
 *              "EUR":{"max":2736.98,"remaining":2736.98},
 *              "GBP":{"max":1960.52,"remaining":1960.52},
 *              "CAD":{"max":3953.37,"remaining":3953.37}
 *          },
 *          "sell":{
 *              "USD":{"max":3000,"remaining":2000},
 *              "EUR":{"max":2736.98,"remaining":1858.74},
 *              "GBP":{"max":1960.52,"remaining":1323.19},
 *              "CAD":{"max":3953.37,"remaining":2656.11}
 *          },
 *          "exchange_withdraw":{
 *              "USD":{"max":10000,"remaining":7000},
 *              "EUR":{"max":8779.63,"remaining":6145.75},
 *              "GBP":{"max":7011.39,"remaining":4907.98},
 *              "CAD":{"max":13080.25,"remaining":9156.18},
 *              "BTC":{"max":100,"remaining":70},
 *              "ETH":{"max":1000,"remaining":700},
 *              "LTC":{"max":3000,"remaining":2100}
 *          }
 *      }
 * }
 *
 */
interface LimitsDataInterface
{
    public function getLimitCurrency(): string;
    public function getTransferLimits(): array;
}
