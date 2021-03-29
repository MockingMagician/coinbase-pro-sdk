<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket;

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberAuthenticationAwareInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberInterface;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Signer;

/**
 * @internal
 */
final class SubscriberAuthenticated extends AbstractSubscriber implements SubscriberAuthenticationAwareInterface
{
    /**
     * @var ApiInterface
     */
    private $coinbaseApi;
    /**
     * @var null|TimeInterface
     */
    private $time;

    public function __construct(ApiInterface $api, ?TimeInterface $time)
    {
        $this->coinbaseApi = $api;
        $this->time = $time;
    }

    public function activateChannelUser(bool $activate, array $productIds = []): void
    {
        $this->activateChannel('user', $activate, $productIds);
    }

    public function getPayload(bool $unsubscribe = false): array
    {
        $payload = parent::getPayload($unsubscribe);

        $params = $this->coinbaseApi->getRequestFactory()->getParams();
        $signData = Signer::sign(
            $params->getKey(),
            $params->getSecret(),
            $params->getPassphrase(),
            SubscriberInterface::AUTHENTICATION_LIKE_METHOD,
            SubscriberInterface::AUTHENTICATION_LIKE_URI,
            '',
            $this->time ? $this->time->getTime()->getEpoch() : time()
        );

        $payload['signature'] = $signData->getSignature();
        $payload['key'] = $signData->getKey();
        $payload['passphrase'] = $signData->getPassphrase();
        $payload['timestamp'] = $signData->getTimestamp();

        return $payload;
    }
}
