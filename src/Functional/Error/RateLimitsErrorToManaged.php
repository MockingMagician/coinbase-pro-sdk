<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Error;

use MockingMagician\CoinbaseProSdk\Contracts\Error\ApiErrorInterface;
use PHPUnit\Framework\Exception;
use Throwable;

class RateLimitsErrorToManaged extends ApiError
{
}
