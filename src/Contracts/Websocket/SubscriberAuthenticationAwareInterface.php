<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Websocket;

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;

interface SubscriberAuthenticationAwareInterface extends SubscriberInterface
{
    public function getCoinbaseApi(): ApiInterface;

    public function runWithAuthentication(bool $bool, bool $useCoinbaseRemoteTime = false): void;

    public function activateChannelUser(bool $activate, array $productIds = []): void;
}
