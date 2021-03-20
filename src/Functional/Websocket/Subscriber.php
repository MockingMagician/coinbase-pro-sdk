<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket;

use MockingMagician\CoinbaseProSdk\Contracts\Api\ApiInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Signer;

class Subscriber implements SubscriberInterface
{
    /**
     * @var null|ApiInterface
     */
    private $coinbaseApi;

    /**
     * @var bool
     */
    private $authenticate;

    /**
     * @var array
     */
    private $payloadTemplate = [
        'type' => null,
        'product_ids' => [],
        'channels' => [],
    ];

    /**
     * @var bool
     */
    private $useCoinbaseRemoteTime;

    public function __construct(?ApiInterface $coinbaseApi)
    {
        $this->coinbaseApi = $coinbaseApi;
        $this->authenticate = false;
        $this->useCoinbaseRemoteTime = false;
    }

    public function runWithAuthentication(bool $bool, bool $useCoinbaseRemoteTime = false): void
    {
        if (is_null($this->coinbaseApi)) {
            throw new ApiError('Run with authentication is not possible if coinbaseApi is not provided');
        }

        $this->authenticate = $bool;
        $this->useCoinbaseRemoteTime = $useCoinbaseRemoteTime;
    }

    public function setProductIds(array $productIds): void
    {
        $this->payloadTemplate['product_ids'] = $productIds;
    }

    private function activateChannel(string $channelKey, bool $activate, ?array $productIds): void
    {
        if ($activate) {
            $this->payloadTemplate['channels'][$channelKey] = ['name' => $channelKey];
            if (!is_null($productIds) && !empty($productIds)) {
                $this->payloadTemplate['channels'][$channelKey]['product_ids'] = $productIds;
            }

            return;
        }

        if (isset($this->payloadTemplate['channels'][$channelKey])) {
            unset($this->payloadTemplate['channels'][$channelKey]);
        }
    }

    public function activateChannelHeartbeat(bool $activate, array $productIds = []): void
    {
        $this->activateChannel('heartbeat', $activate, $productIds);
    }

    public function activateChannelStatus(bool $activate): void
    {
        $this->activateChannel('status', $activate, null);
    }

    public function activateChannelTicker(bool $activate, array $productIds = []): void
    {
        $this->activateChannel('ticker', $activate, $productIds);
    }

    public function activateChannelLevel2(bool $activate, array $productIds = []): void
    {
        $this->activateChannel('level2', $activate, $productIds);
    }

    public function activateChannelUser(bool $activate, array $productIds = []): void
    {
        if (!$this->authenticate) {
            throw new ApiError('Activate channel user require to be authenticated, first activate with runWithAuthentication method');
        }
        $this->activateChannel('user', $activate, $productIds);
    }

    public function activateChannelFull(bool $activate, array $productIds = []): void
    {
        $this->activateChannel('full', $activate, $productIds);
    }

    public function activateChannelMatches(bool $activate, array $productIds = []): void
    {
        $this->activateChannel('matches', $activate, $productIds);
    }

    public function getPayload(bool $unsubscribe = false): string
    {
        $payload = $this->payloadTemplate;
        $payload['type'] = $unsubscribe ? 'unsubscribe' : 'subscribe';
        $payload['channels'] = array_values($this->payloadTemplate['channels']);

        if ($this->authenticate) {
            $params = $this->coinbaseApi->getRequestFactory()->getParams();
            $signData = Signer::sign(
                $params->getKey(),
                $params->getSecret(),
                $params->getPassphrase(),
                SubscriberInterface::AUTHENTICATION_LIKE_METHOD,
                SubscriberInterface::AUTHENTICATION_LIKE_URI,
                '',
                $this->useCoinbaseRemoteTime ? $this->coinbaseApi->time()->getTime() : time()
            );
            $payload['signature'] = $signData->getSignature();
            $payload['key'] = $signData->getKey();
            $payload['passphrase'] = $signData->getPassphrase();
            $payload['timestamp'] = $signData->getTimestamp();
        }

        return Json::encode($payload);
    }
}
