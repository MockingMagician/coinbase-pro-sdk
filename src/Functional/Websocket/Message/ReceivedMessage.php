<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

class ReceivedMessage extends AbstractMORDMessage
{
    /**
     * @var string
     */
    private $orderType;

    /**
     * @var int
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

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->orderType = $payload['order_type'];
        $this->size = (int) $payload['size'];
        $this->clientOrderId = $payload['client_oid'] ?? null;
        $this->orderId = $payload['order_id'];
    }

    public function getOrderType(): string
    {
        return $this->orderType;
    }

    public function getSize(): int
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
}
