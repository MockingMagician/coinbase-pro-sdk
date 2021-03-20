<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

class ChangeMessage extends AbstractFullChannelMessage
{
    /**
     * @var int
     */
    private $sequence;

    /**
     * @var string
     */
    private $orderId;

    /**
     * @var null|float
     */
    private $newSize;

    /**
     * @var null|float
     */
    private $oldSize;

    /**
     * @var null|float
     */
    private $newFunds;

    /**
     * @var null|float
     */
    private $oldFunds;

    /**
     * @var float
     */
    private $price;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->sequence = (int) $payload['sequence'];
        $this->orderId = $payload['order_id'];
        $this->newSize = isset($payload['new_size']) ? (float) $payload['new_size'] : null;
        $this->oldSize = isset($payload['old_size']) ? (float) $payload['old_size'] : null;
        $this->newFunds = isset($payload['new_funds']) ? (float) $payload['new_funds'] : null;
        $this->oldFunds = isset($payload['old_funds']) ? (float) $payload['old_funds'] : null;
        $this->price = (float) $payload['price'];
    }

    public function getSequence(): int
    {
        return $this->sequence;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getNewSize(): ?float
    {
        return $this->newSize;
    }

    public function getOldSize(): ?float
    {
        return $this->oldSize;
    }

    public function getNewFunds(): ?float
    {
        return $this->newFunds;
    }

    public function getOldFunds(): ?float
    {
        return $this->oldFunds;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
