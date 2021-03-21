<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket;

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberAuthenticationAwareInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Signer;

class SubscriberAuthenticateAware extends Subscriber implements SubscriberAuthenticationAwareInterface
{
    /**
     * @var null|ApiInterface
     */
    private $coinbaseApi;
    /**
     * @var bool
     */
    private $useCoinbaseRemoteTime;
    /**
     * @var bool
     */
    private $authenticate;

    public function __construct(ApiInterface $api)
    {
        $this->coinbaseApi = $api;
        $this->authenticate = false;
        $this->useCoinbaseRemoteTime = false;
    }

    public function getCoinbaseApi(): ApiInterface
    {
        return $this->coinbaseApi;
    }

    public function runWithAuthentication(bool $bool, bool $useCoinbaseRemoteTime = false): void
    {
        $this->authenticate = $bool;
        $this->useCoinbaseRemoteTime = $useCoinbaseRemoteTime;
    }

    public function activateChannelUser(bool $activate, array $productIds = []): void
    {
        if (!$this->authenticate) {
            throw new ApiError('Activate channel user require to be authenticated, first activate with runWithAuthentication method');
        }
        $this->activateChannel('user', $activate, $productIds);
    }

    public function getPayload(bool $unsubscribe = false): array
    {
        $payload = parent::getPayload($unsubscribe);

        if ($this->authenticate) {
            $params = $this->coinbaseApi->getRequestFactory()->getParams();
            $signData = Signer::sign(
                $params->getKey(),
                $params->getSecret(),
                $params->getPassphrase(),
                SubscriberInterface::AUTHENTICATION_LIKE_METHOD,
                SubscriberInterface::AUTHENTICATION_LIKE_URI,
                '',
                $this->useCoinbaseRemoteTime ? $this->coinbaseApi->time()->getTime()->getEpoch() : time()
            );
            $payload['signature'] = $signData->getSignature();
            $payload['key'] = $signData->getKey();
            $payload['passphrase'] = $signData->getPassphrase();
            $payload['timestamp'] = $signData->getTimestamp();
        }

        return $payload;
    }
}
