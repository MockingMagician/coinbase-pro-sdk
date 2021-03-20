<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

class OpenMessage extends AbstractFullChannelMessage
{
    /**
     * @var float
     */
    private $remainingSize;

    /**
     * @var string
     */
    private $orderId;

    /**
     * @var int
     */
    private $sequence;

    /**
     * @var null|float
     */
    private $price;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->remainingSize = isset($payload['remaining_size']) ? (float) $payload['remaining_size'] : null;
        $this->orderId = $payload['order_id'];
        $this->sequence = (int) $payload['sequence'];
        $this->price = isset($payload['price']) ? (float) $payload['price'] : null;
    }

    public function getRemainingSize(): float
    {
        return $this->remainingSize;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getSequence(): int
    {
        return $this->sequence;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }
}
