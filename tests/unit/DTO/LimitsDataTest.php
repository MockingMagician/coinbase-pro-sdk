<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\LimitsData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\LimitsData
 *
 * @internal
 */
class LimitsDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "limit_currency": "USD",
                    "transfer_limits": {
                        "ach": {
                            "USD": {
                                "max": 50,
                                "remaining": 25
                            },
                            "EUR": {
                                "max": 45.48,
                                "remaining": 22.74
                            },
                            "GBP": {
                                "max": 32.64,
                                "remaining": 16.32
                            },
                            "CAD": {
                                "max": 65.8,
                                "remaining": 32.9
                            }
                        },
                        "instant_buy": {
                            "USD": {
                                "max": 0,
                                "remaining": 0
                            },
                            "EUR": {
                                "max": 0,
                                "remaining": 0
                            },
                            "GBP": {
                                "max": 0,
                                "remaining": 0
                            },
                            "CAD": {
                                "max": 0,
                                "remaining": 0
                            }
                        },
                        "secure3d_buy": {
                            "USD": {
                                "max": 0,
                                "remaining": 0
                            },
                            "EUR": {
                                "max": 0,
                                "remaining": 0
                            },
                            "GBP": {
                                "max": 0,
                                "remaining": 0
                            },
                            "CAD": {
                                "max": 0,
                                "remaining": 0
                            }
                        },
                        "buy": {
                            "USD": {
                                "max": 3000,
                                "remaining": 3000
                            },
                            "EUR": {
                                "max": 2736.98,
                                "remaining": 2736.98
                            },
                            "GBP": {
                                "max": 1960.52,
                                "remaining": 1960.52
                            },
                            "CAD": {
                                "max": 3953.37,
                                "remaining": 3953.37
                            }
                        },
                        "sell": {
                            "USD": {
                                "max": 3000,
                                "remaining": 2000
                            },
                            "EUR": {
                                "max": 2736.98,
                                "remaining": 1858.74
                            },
                            "GBP": {
                                "max": 1960.52,
                                "remaining": 1323.19
                            },
                            "CAD": {
                                "max": 3953.37,
                                "remaining": 2656.11
                            }
                        },
                        "exchange_withdraw": {
                            "USD": {
                                "max": 10000,
                                "remaining": 7000
                            },
                            "EUR": {
                                "max": 8779.63,
                                "remaining": 6145.75
                            },
                            "GBP": {
                                "max": 7011.39,
                                "remaining": 4907.98
                            },
                            "CAD": {
                                "max": 13080.25,
                                "remaining": 9156.18
                            },
                            "BTC": {
                                "max": 100,
                                "remaining": 70
                            },
                            "ETH": {
                                "max": 1000,
                                "remaining": 700
                            },
                            "LTC": {
                                "max": 3000,
                                "remaining": 2100
                            }
                        }
                    }
                }',
            ],
        ];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var LimitsData $holdData */
        $holdData = LimitsData::createFromJson($json);
        self::assertInstanceOf(LimitsData::class, $holdData);
        self::assertEquals('USD', $holdData->getLimitCurrency());
        self::assertEquals([
            'ach' => [
                'USD' => [
                    'max' => 50,
                    'remaining' => 25,
                ],
                'EUR' => [
                    'max' => 45.48,
                    'remaining' => 22.74,
                ],
                'GBP' => [
                    'max' => 32.64,
                    'remaining' => 16.32,
                ],
                'CAD' => [
                    'max' => 65.8,
                    'remaining' => 32.9,
                ],
            ],
            'instant_buy' => [
                'USD' => [
                    'max' => 0,
                    'remaining' => 0,
                ],
                'EUR' => [
                    'max' => 0,
                    'remaining' => 0,
                ],
                'GBP' => [
                    'max' => 0,
                    'remaining' => 0,
                ],
                'CAD' => [
                    'max' => 0,
                    'remaining' => 0,
                ],
            ],
            'secure3d_buy' => [
                'USD' => [
                    'max' => 0,
                    'remaining' => 0,
                ],
                'EUR' => [
                    'max' => 0,
                    'remaining' => 0,
                ],
                'GBP' => [
                    'max' => 0,
                    'remaining' => 0,
                ],
                'CAD' => [
                    'max' => 0,
                    'remaining' => 0,
                ],
            ],
            'buy' => [
                'USD' => [
                    'max' => 3000,
                    'remaining' => 3000,
                ],
                'EUR' => [
                    'max' => 2736.98,
                    'remaining' => 2736.98,
                ],
                'GBP' => [
                    'max' => 1960.52,
                    'remaining' => 1960.52,
                ],
                'CAD' => [
                    'max' => 3953.37,
                    'remaining' => 3953.37,
                ],
            ],
            'sell' => [
                'USD' => [
                    'max' => 3000,
                    'remaining' => 2000,
                ],
                'EUR' => [
                    'max' => 2736.98,
                    'remaining' => 1858.74,
                ],
                'GBP' => [
                    'max' => 1960.52,
                    'remaining' => 1323.19,
                ],
                'CAD' => [
                    'max' => 3953.37,
                    'remaining' => 2656.11,
                ],
            ],
            'exchange_withdraw' => [
                'USD' => [
                    'max' => 10000,
                    'remaining' => 7000,
                ],
                'EUR' => [
                    'max' => 8779.63,
                    'remaining' => 6145.75,
                ],
                'GBP' => [
                    'max' => 7011.39,
                    'remaining' => 4907.98,
                ],
                'CAD' => [
                    'max' => 13080.25,
                    'remaining' => 9156.18,
                ],
                'BTC' => [
                    'max' => 100,
                    'remaining' => 70,
                ],
                'ETH' => [
                    'max' => 1000,
                    'remaining' => 700,
                ],
                'LTC' => [
                    'max' => 3000,
                    'remaining' => 2100,
                ],
            ],
        ], $holdData->getTransferLimits());
    }
}
