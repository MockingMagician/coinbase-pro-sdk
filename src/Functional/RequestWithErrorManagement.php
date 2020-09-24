<?php


namespace MockingMagician\CoinbaseProSdk\Functional;


use MockingMagician\CoinbaseProSdk\Contracts\RequestInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\RateLimitsErrorToManaged;
use MockingMagician\CoinbaseProSdk\Functional\Error\CurlErrorToManaged;
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

    private $countHandlesExceptionalError = 0;

    public function __construct(Request $request, bool $manageRateLimits = true)
    {
        $this->request = $request;
        $this->manageRateLimits = $manageRateLimits;
    }

    public function send()
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
                usleep(ceil(25000 * sqrt(++$this->countHandlesExceptionalError)));
                continue;
            }
        }
    } // @codeCoverageIgnore

    public function setMustBeSigned(bool $set): RequestInterface
    {
        $this->request->setMustBeSigned($set);

        return $this;
    }
}
