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

class ApiError extends Exception implements ApiErrorInterface
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getApiMessage(): string
    {
        return $this->getMessage();
    }
}
