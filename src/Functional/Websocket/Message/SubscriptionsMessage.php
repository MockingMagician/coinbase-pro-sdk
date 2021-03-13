<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;


use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\Fragment\Channel;

class SubscriptionsMessage extends AbstractMessage
{
    /**
     * @var Channel[]
     */
    private $channels;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->channels = [];
        foreach ($payload['channels'] as $channel) {
            $this->channels[] = new Channel($channel['name'], $channel['product_ids']);
        }
    }

    /**
     * @return Channel[]
     */
    public function getChannels(): array
    {
        return $this->channels;
    }
}
