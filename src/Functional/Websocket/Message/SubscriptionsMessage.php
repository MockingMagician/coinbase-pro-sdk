<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

use MockingMagician\CoinbaseProSdk\Functional\DTO\ChannelData;

class SubscriptionsMessage extends AbstractMessage
{
    /**
     * @var ChannelData[]
     */
    private $channels;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->channels = [];
        foreach ($payload['channels'] as $channel) {
            $this->channels[] = ChannelData::createFromArray($channel);
        }
    }

    /**
     * @return ChannelData[]
     */
    public function getChannels(): array
    {
        return $this->channels;
    }
}
