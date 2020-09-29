<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\DTO;

use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\PaymentMethodData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\PaymentMethodLimitsData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\PaymentMethodLimitsDetailsData;
use MockingMagician\CoinbaseProSdk\Tests\CommonHelpers\TraitAssertMore;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\AbstractCreator
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\PaymentMethodData
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\PaymentMethodLimitsData
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\PaymentMethodLimitsDetailsData
 * @covers \MockingMagician\CoinbaseProSdk\Functional\DTO\PaymentMethodLimitsAmountDetailsData
 *
 * @internal
 */
class PaymentMethodDataTest extends TestCase
{
    use TraitAssertMore;

    public function provideValidJsonData()
    {
        return [
            [
                '{
                    "id": "6a23926d-74b6-4373-8434-9d437c2bafb2",
                    "type": "ach_bank_account",
                    "verified": false,
                    "verification_method": "cdv",
                    "cdv_status": "ready",
                    "name": "TD Bank ******2778",
                    "currency": "USD",
                    "primary_buy": true,
                    "primary_sell": true,
                    "allow_buy": true,
                    "allow_sell": true,
                    "allow_deposit": true,
                    "allow_withdraw": true,
                    "created_at": "2013-06-27T16:53:47Z",
                    "updated_at": "2013-06-27T16:54:46Z",
                    "resource": "payment_method",
                    "resource_path": "\/v2\/payment-methods\/6a23926d-74b6-4373-8434-9d437c2bafb2",
                    "limits": {
                        "buy": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "100000.00",
                                    "currency": "USD"
                                },
                                "remaining": {
                                    "amount": "100000.00",
                                    "currency": "USD"
                                }
                            }
                        ],
                        "instant_buy": [
                            {
                                "period_in_days": 7,
                                "total": {
                                    "amount": "1000.00",
                                    "currency": "USD"
                                },
                                "remaining": {
                                    "amount": "1000.00",
                                    "currency": "USD"
                                }
                            }
                        ],
                        "sell": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "100000.00",
                                    "currency": "USD"
                                },
                                "remaining": {
                                    "amount": "100000.00",
                                    "currency": "USD"
                                }
                            }
                        ],
                        "deposit": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "50000.00",
                                    "currency": "USD"
                                },
                                "remaining": {
                                    "amount": "50000.00",
                                    "currency": "USD"
                                }
                            }
                        ]
                    }
                }',
            ],
            [
                '{
                    "id": "b22911ee-ef35-5c97-bdd4-aef3f65618d9",
                    "type": "fiat_account",
                    "name": "GBP Wallet",
                    "currency": "GBP",
                    "primary_buy": false,
                    "primary_sell": false,
                    "allow_buy": true,
                    "allow_sell": true,
                    "allow_deposit": true,
                    "allow_withdraw": true,
                    "created_at": "2013-06-27T16:53:47Z",
                    "updated_at": "2013-06-27T16:54:46Z",
                    "resource": "payment_method",
                    "resource_path": "\/v2\/payment-methods\/b22911ee-ef35-5c97-bdd4-aef3f65618d9",
                    "limits": {
                        "buy": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "63716.70",
                                    "currency": "GBP"
                                },
                                "remaining": {
                                    "amount": "63716.70",
                                    "currency": "GBP"
                                }
                            }
                        ],
                        "sell": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "63716.70",
                                    "currency": "GBP"
                                },
                                "remaining": {
                                    "amount": "63716.70",
                                    "currency": "GBP"
                                }
                            }
                        ]
                    },
                    "fiat_account": {
                        "id": "eebff577-b756-58ec-9387-9bd2b8f4c4ea",
                        "resource": "account"
                    }
                }'
            ],
        ];
    }

    public function provideValidJsonDataCollection()
    {
        return [[
            '[
                {
                    "id": "b22911ee-ef35-5c97-bdd4-aef3f65618d9",
                    "type": "fiat_account",
                    "name": "GBP Wallet",
                    "currency": "GBP",
                    "primary_buy": false,
                    "primary_sell": false,
                    "allow_buy": true,
                    "allow_sell": true,
                    "allow_deposit": true,
                    "allow_withdraw": true,
                    "created_at": "2015-04-17T03:00:55Z",
                    "updated_at": "2015-04-17T03:00:55Z",
                    "resource": "payment_method",
                    "resource_path": "\/v2\/payment-methods\/b22911ee-ef35-5c97-bdd4-aef3f65618d9",
                    "limits": {
                        "buy": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "63716.70",
                                    "currency": "GBP"
                                },
                                "remaining": {
                                    "amount": "63716.70",
                                    "currency": "GBP"
                                }
                            }
                        ],
                        "sell": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "63716.70",
                                    "currency": "GBP"
                                },
                                "remaining": {
                                    "amount": "63716.70",
                                    "currency": "GBP"
                                }
                            }
                        ]
                    },
                    "fiat_account": {
                        "id": "eebff577-b756-58ec-9387-9bd2b8f4c4ea",
                        "resource": "account"
                    }
                },
                {
                    "id": "e49c8d15-547b-464e-ac3d-4b9d20b360ec",
                    "type": "fiat_account",
                    "name": "USD Wallet",
                    "currency": "USD",
                    "primary_buy": false,
                    "primary_sell": false,
                    "allow_buy": true,
                    "allow_sell": true,
                    "allow_deposit": true,
                    "allow_withdraw": true,
                    "created_at": "2014-11-19T00:54:39Z",
                    "updated_at": "2014-11-19T00:54:39Z",
                    "resource": "payment_method",
                    "resource_path": "\/v2\/payment-methods\/e49c8d15-547b-464e-ac3d-4b9d20b360ec",
                    "limits": {
                        "buy": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "100000.00",
                                    "currency": "USD"
                                },
                                "remaining": {
                                    "amount": "100000.00",
                                    "currency": "USD"
                                }
                            }
                        ],
                        "sell": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "100000.00",
                                    "currency": "USD"
                                },
                                "remaining": {
                                    "amount": "100000.00",
                                    "currency": "USD"
                                }
                            }
                        ]
                    },
                    "fiat_account": {
                        "id": "1b4b4fbc-8071-5e7c-b36e-a1c589a2cf20",
                        "resource": "account"
                    }
                },
                {
                    "id": "ec3c2e04-e877-4c21-b6d2-1f26744c00c3",
                    "type": "fiat_account",
                    "name": "EUR Wallet",
                    "currency": "EUR",
                    "primary_buy": false,
                    "primary_sell": false,
                    "allow_buy": true,
                    "allow_sell": true,
                    "allow_deposit": true,
                    "allow_withdraw": true,
                    "created_at": "2014-08-19T03:24:25Z",
                    "updated_at": "2014-08-19T03:24:25Z",
                    "resource": "payment_method",
                    "resource_path": "\/v2\/payment-methods\/ec3c2e04-e877-4c21-b6d2-1f26744c00c3",
                    "limits": {
                        "buy": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "89821.70",
                                    "currency": "EUR"
                                },
                                "remaining": {
                                    "amount": "89821.70",
                                    "currency": "EUR"
                                }
                            }
                        ],
                        "sell": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "89821.70",
                                    "currency": "EUR"
                                },
                                "remaining": {
                                    "amount": "89821.70",
                                    "currency": "EUR"
                                }
                            }
                        ]
                    },
                    "fiat_account": {
                        "id": "1ae77dce-11c5-51c7-9f55-e2b427c4837b",
                        "resource": "account"
                    }
                },
                {
                    "id": "9143hklo-d975-54df-bb60-64347682bfb7",
                    "type": "fedwire",
                    "name": "Chase:****4442",
                    "currency": "USD",
                    "primary_buy": false,
                    "primary_sell": false,
                    "instant_buy": false,
                    "instant_sell": false,
                    "created_at": "2019-12-09T02:02:33Z",
                    "updated_at": "2019-12-09T02:02:33Z",
                    "resource": "payment_method",
                    "resource_path": "\/v2\/payment-methods\/9143hklo-d975-54df-bb60-64347682bfb7",
                    "limits": {
                        "type": "wire",
                        "name": "Bank Wire"
                    },
                    "allow_buy": false,
                    "allow_sell": false,
                    "allow_deposit": false,
                    "allow_withdraw": true,
                    "verified": true,
                    "picker_data": {
                        "symbol": "fedwire",
                        "account_name": "Chase",
                        "account_number": "****4442",
                        "routing_number": "021000021"
                    },
                    "hold_business_days": 0,
                    "hold_days": 0
                },
                {
                    "id": "6a23926d-74b6-4373-8434-9d437c2bafb2",
                    "type": "ach_bank_account",
                    "verified": false,
                    "verification_method": "cdv",
                    "cdv_status": "ready",
                    "name": "TD Bank ******2778",
                    "currency": "USD",
                    "primary_buy": true,
                    "primary_sell": true,
                    "allow_buy": true,
                    "allow_sell": true,
                    "allow_deposit": true,
                    "allow_withdraw": true,
                    "created_at": "2013-06-27T16:53:47Z",
                    "updated_at": "2013-06-27T16:54:46Z",
                    "resource": "payment_method",
                    "resource_path": "\/v2\/payment-methods\/6a23926d-74b6-4373-8434-9d437c2bafb2",
                    "limits": {
                        "buy": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "100000.00",
                                    "currency": "USD"
                                },
                                "remaining": {
                                    "amount": "100000.00",
                                    "currency": "USD"
                                }
                            },
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "50000.00",
                                    "currency": "USD"
                                },
                                "remaining": {
                                    "amount": "50000.00",
                                    "currency": "USD"
                                }
                            }
                        ],
                        "instant_buy": [
                            {
                                "period_in_days": 7,
                                "total": {
                                    "amount": "1000.00",
                                    "currency": "USD"
                                },
                                "remaining": {
                                    "amount": "1000.00",
                                    "currency": "USD"
                                }
                            }
                        ],
                        "sell": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "100000.00",
                                    "currency": "USD"
                                },
                                "remaining": {
                                    "amount": "100000.00",
                                    "currency": "USD"
                                }
                            }
                        ],
                        "deposit": [
                            {
                                "period_in_days": 1,
                                "total": {
                                    "amount": "50000.00",
                                    "currency": "USD"
                                },
                                "remaining": {
                                    "amount": "50000.00",
                                    "currency": "USD"
                                }
                            }
                        ]
                    }
                }
            ]',
        ]];
    }

    /**
     * @dataProvider provideValidJsonData
     */
    public function testCreateFromJson(string $json)
    {
        /** @var PaymentMethodData $paymentMethodData */
        $paymentMethodData = PaymentMethodData::createFromJson($json);
        self::assertInstanceOf(PaymentMethodData::class, $paymentMethodData);
        self::assertEqualsOneOf(['6a23926d-74b6-4373-8434-9d437c2bafb2', 'b22911ee-ef35-5c97-bdd4-aef3f65618d9'], $paymentMethodData->getId());
        self::assertEqualsOneOf(['ach_bank_account', 'fiat_account'], $paymentMethodData->getType());
        self::assertIsBool(false, $paymentMethodData->isVerified());
        self::assertNullOrEquals('cdv', $paymentMethodData->getVerificationMethod());
        self::assertNullOrEquals('ready', $paymentMethodData->getCdvStatus());
        self::assertEqualsOneOf(['TD Bank ******2778', 'GBP Wallet'], $paymentMethodData->getName());
        self::assertEqualsOneOf(['USD', 'GBP'], $paymentMethodData->getCurrency());
        self::assertIsBool($paymentMethodData->isPrimaryBuy());
        self::assertIsBool($paymentMethodData->isPrimarySell());
        self::assertIsBool($paymentMethodData->isAllowBuy());
        self::assertIsBool($paymentMethodData->isAllowSell());
        self::assertIsBool($paymentMethodData->isAllowDeposit());
        self::assertIsBool($paymentMethodData->isAllowWithdraw());
        self::assertEquals(new \DateTime('2013-06-27T16:53:47Z'), $paymentMethodData->getCreatedAt());
        self::assertEquals(new \DateTime('2013-06-27T16:54:46Z'), $paymentMethodData->getUpdatedAt());
        self::assertEquals('payment_method', $paymentMethodData->getResource());
        self::assertEqualsOneOf(['/v2/payment-methods/6a23926d-74b6-4373-8434-9d437c2bafb2', '/v2/payment-methods/b22911ee-ef35-5c97-bdd4-aef3f65618d9'], $paymentMethodData->getResourcePath());
        $limits = $paymentMethodData->getLimits();
        self::assertInstanceOf(PaymentMethodLimitsData::class, $limits);
        $buy = $limits->getBuy();
        foreach ($buy as $b) {
            self::assertInstanceOf(PaymentMethodLimitsDetailsData::class, $b);
            self::assertEquals(1, $b->getPeriodInDays());
            $total = $b->getTotal();
            self::assertEqualsOneOf([100000, 63716.70], $total->getAmount());
            self::assertEqualsOneOf(['USD', 'GBP'], $total->getCurrency());
            $remaining = $b->getRemaining();
            self::assertEqualsOneOf([100000, 63716.70], $remaining->getAmount());
            self::assertEqualsOneOf(['USD', 'GBP'], $remaining->getCurrency());
        }
        $instantBuy = $limits->getInstantBuy();
        self::assertNullOrInstanceOf(PaymentMethodLimitsDetailsData::class, $instantBuy[0] ?? null);
        $sell = $limits->getSell();
        self::assertNullOrInstanceOf(PaymentMethodLimitsDetailsData::class, $sell[0] ?? null);
        $deposit = $limits->getDeposit();
        self::assertNullOrInstanceOf(PaymentMethodLimitsDetailsData::class, $deposit[0] ?? null);
    }

    /**
     * @dataProvider provideValidJsonDataCollection
     */
    public function testCreateFromJsonCollection(string $json)
    {
        $collection = PaymentMethodData::createCollectionFromJson($json);
        self::assertIsArray($collection);
        foreach ($collection as $value) {
            self::assertInstanceOf(PaymentMethodData::class, $value);
        }
    }
}
