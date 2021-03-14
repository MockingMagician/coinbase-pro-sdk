<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

use DateTimeImmutable;

class HeartbeatMessage extends AbstractMessage
{
    /**
     * @var int
     */
    private $lastTradeId;
    /**
     * @var string
     */
    private $productId;
    /**
     * @var int
     */
    private $sequence;
    /**
     * @var DateTimeImmutable
     */
    private $time;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->lastTradeId = (int) $payload['last_trade_id'];
        $this->productId = $payload['product_id'];
        $this->sequence = (int) $payload['sequence'];
        $this->time = new DateTimeImmutable($payload['time']);
    }

    public function getLastTradeId(): int
    {
        return $this->lastTradeId;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getSequence(): int
    {
        return $this->sequence;
    }

    public function getTime(): DateTimeImmutable
    {
        return $this->time;
    }
}
