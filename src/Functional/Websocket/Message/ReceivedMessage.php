<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

class ReceivedMessage extends AbstractFullChannelMessage
{
    /**
     * @var string
     */
    private $orderType;

    /**
     * @var null|float
     */
    private $size;

    /**
     * @var null|string
     */
    private $clientOrderId;

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

    /**
     * @var null|float
     */
    private $funds;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->sequence = (int) $payload['sequence'];
        $this->orderType = $payload['order_type'];
        $this->size = isset($payload['size']) ? (float) $payload['size'] : null;
        $this->price = isset($payload['price']) ? (float) $payload['price'] : null;
        $this->funds = isset($payload['funds']) ? (float) $payload['funds'] : null;
        $this->clientOrderId = $payload['client_oid'] ?? null;
        $this->orderId = $payload['order_id'];
    }

    public function getOrderType(): string
    {
        return $this->orderType;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function getClientOrderId(): ?string
    {
        return $this->clientOrderId;
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

    public function getFunds(): ?float
    {
        return $this->funds;
    }
}
