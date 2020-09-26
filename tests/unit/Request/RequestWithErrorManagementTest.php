<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\Request;

use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use MockingMagician\CoinbaseProSdk\Functional\Error\CurlErrorToManaged;
use MockingMagician\CoinbaseProSdk\Functional\Error\RateLimitsErrorToManaged;
use MockingMagician\CoinbaseProSdk\Functional\Error\TimestampExpiredErrorToManaged;
use MockingMagician\CoinbaseProSdk\Functional\Request\Request;
use MockingMagician\CoinbaseProSdk\Functional\Request\RequestWithErrorManagement;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @covers MockingMagician\CoinbaseProSdk\Functional\Request\RequestWithErrorManagement
 *
 * @internal
 */
class RequestWithErrorManagementTest extends TestCase
{
    public const VALID_API_RETURN = '{"key": "value"}';

    public function testSendSuccess()
    {
        $request = $this->prophesize(Request::class);

        $request->send()->willReturn(self::VALID_API_RETURN)->shouldBeCalledOnce();

        $request = new RequestWithErrorManagement($request->reveal());

        self::assertEquals(self::VALID_API_RETURN, $request->send());
    }

    public function testMustBeSigned()
    {
        $request = $this->prophesize(Request::class);

        $request
            ->setMustBeSigned(Argument::type('bool'))
            ->willReturn($this->prophesize(RequestInterface::class)->reveal())
            ->shouldBeCalledTimes(2)
        ;

        $request = new RequestWithErrorManagement($request->reveal());

        $request->setMustBeSigned(true);
        $request->setMustBeSigned(false);
    }

    public function testSendRetryAndSuccessWithApiRateLimitsError()
    {
        $request = $this->prophesize(Request::class);

        $generator = (function () {
            for ($i = 0; $i < 5; ++$i) {
                if ($i < 4) {
                    yield new RateLimitsErrorToManaged();

                    continue;
                }

                yield self::VALID_API_RETURN;
            }
        })();

        $request->send()->will(function () use ($generator) {
            $value = $generator->current();
            $generator->next();
            if ($value instanceof ApiError) {
                throw $value;
            }

            return $value;
        })->shouldBeCalledTimes(5);

        $request = new RequestWithErrorManagement($request->reveal());

        self::assertEquals(self::VALID_API_RETURN, $request->send());
    }

    public function testSendRetryAndFailWithApiRateLimitsErrorIfNotManaged()
    {
        $request = $this->prophesize(Request::class);

        $generator = (function () {
            for ($i = 0; $i < 5; ++$i) {
                if ($i < 4) {
                    yield new RateLimitsErrorToManaged();

                    continue;
                }

                yield self::VALID_API_RETURN;
            }
        })();

        $request->send()->will(function () use ($generator) {
            $value = $generator->current();
            $generator->next();
            if ($value instanceof ApiError) {
                throw $value;
            }

            return $value;
        })->shouldBeCalledTimes(1);

        $request = new RequestWithErrorManagement($request->reveal(), false);

        $this->expectException(RateLimitsErrorToManaged::class);

        $request->send();
    }

    public function testSendRetryAndSuccessWithCurlOrTimestampErrorToManaged()
    {
        $request = $this->prophesize(Request::class);

        $generator = (function () {
            for ($i = 0; $i < 8; ++$i) {
                if ($i < 3) {
                    yield new CurlErrorToManaged();

                    continue;
                }

                if ($i < 6) {
                    yield new TimestampExpiredErrorToManaged();

                    continue;
                }

                yield self::VALID_API_RETURN;
            }
        })();

        $request->send()->will(function () use ($generator) {
            $value = $generator->current();
            $generator->next();
            if ($value instanceof ApiError) {
                throw $value;
            }

            return $value;
        })->shouldBeCalledTimes(7);

        $request = new RequestWithErrorManagement($request->reveal(), false);

        self::assertEquals(self::VALID_API_RETURN, $request->send());
    }
}
