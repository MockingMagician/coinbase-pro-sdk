<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket;

use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberAuthenticationAwareInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

final class Subscriber extends AbstractSubscriber implements SubscriberAuthenticationAwareInterface
{
    public function activateChannelUser(bool $activate, array $productIds = []): void
    {
        throw new ApiError(sprintf('you are running websocket outside of any authentication, %s is not available in this context', __METHOD__));
    }
}
