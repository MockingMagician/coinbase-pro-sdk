<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Websocket;

interface SubscriberInterface
{
    public const AUTHENTICATION_LIKE_METHOD = 'GET';
    public const AUTHENTICATION_LIKE_URI = '/users/self/verify';

    public function runWithAuthentication(bool $bool, bool $useCoinbaseRemoteTime = false): void;

    public function setProductIds(array $productIds): void;

    public function activateChannelHeartbeat(bool $activate, array $productIds = []): void;

    public function activateChannelStatus(bool $activate): void;

    public function activateChannelTicker(bool $activate, array $productIds = []): void;

    public function activateChannelLevel2(bool $activate, array $productIds = []): void;

    public function activateChannelUser(bool $activate, array $productIds = []): void;

    public function activateChannelFull(bool $activate, array $productIds = []): void;

    public function activateChannelMatches(bool $activate, array $productIds = []): void;

    public function getPayload(bool $unsubscribe = false): string;
}
