<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket;

use MockingMagician\CoinbaseProSdk\Contracts\Websocket\SubscriberInterface;

class Subscriber implements SubscriberInterface
{
    /**
     * @var array
     */
    private $payloadTemplate = [
        'type' => null,
        'product_ids' => [],
        'channels' => [],
    ];

    public function setProductIds(array $productIds): void
    {
        $this->payloadTemplate['product_ids'] = $productIds;
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

    public function activateChannelFull(bool $activate, array $productIds = []): void
    {
        $this->activateChannel('full', $activate, $productIds);
    }

    public function activateChannelMatches(bool $activate, array $productIds = []): void
    {
        $this->activateChannel('matches', $activate, $productIds);
    }

    public function getPayload(bool $unsubscribe = false): array
    {
        $payload = $this->payloadTemplate;
        $payload['type'] = $unsubscribe ? 'unsubscribe' : 'subscribe';
        $payload['channels'] = array_values($this->payloadTemplate['channels']);

        return $payload;
    }

    protected function activateChannel(string $channelKey, bool $activate, ?array $productIds): void
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
}
