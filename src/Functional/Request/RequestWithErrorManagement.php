<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Request;

use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\CurlErrorToManaged;
use MockingMagician\CoinbaseProSdk\Functional\Error\RateLimitsErrorToManaged;
use MockingMagician\CoinbaseProSdk\Functional\Error\TimestampExpiredErrorToManaged;

class RequestWithErrorManagement implements RequestInterface
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var bool
     */
    private $manageRateLimits;
    /**
     * @var int
     */
    private $countHandlesExceptionalError = 0;

    public function __construct(Request $request, bool $manageRateLimits = true)
    {
        $this->request = $request;
        $this->manageRateLimits = $manageRateLimits;
    }

    public function send(): string
    {
        while (true) {
            try {
                return $this->request->send();
            } catch (RateLimitsErrorToManaged $exception) {
                if ($this->manageRateLimits) {
                    continue;
                }

                throw $exception;
            } catch (CurlErrorToManaged | TimestampExpiredErrorToManaged $exception) {
                usleep((int) ceil(25000 * sqrt(++$this->countHandlesExceptionalError)));

                continue;
            }
        }
    }

    // @codeCoverageIgnore

    public function setMustBeSigned(bool $set): RequestInterface
    {
        $this->request->setMustBeSigned($set);

        return $this;
    }
}
