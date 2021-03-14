<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

class OpenMessage extends AbstractMORDMessage
{
    /**
     * @var float
     */
    private $remainingSize;

    /**
     * @var string
     */
    private $orderId;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->remainingSize = (float) $payload['remaining_size'];
        $this->orderId = $payload['order_id'];
    }

    public function getRemainingSize(): float
    {
        return $this->remainingSize;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }
}
