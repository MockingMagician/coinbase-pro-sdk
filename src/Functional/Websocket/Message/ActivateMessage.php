<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

class ActivateMessage extends AbstractFullChannelMessage
{
    /**
     * @var string
     */
    private $userId;
    /**
     * @var string
     */
    private $profileId;
    /**
     * @var string
     */
    private $orderId;
    /**
     * @var string
     */
    private $stopType;
    /**
     * @var float
     */
    private $stopPrice;
    /**
     * @var float
     */
    private $size;
    /**
     * @var float
     */
    private $funds;
    /**
     * @var bool
     */
    private $private;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->userId = $payload['user_id'];
        $this->profileId = $payload['profile_id'];
        $this->orderId = $payload['order_id'];
        $this->stopType = $payload['stop_type'];
        $this->stopPrice = (float) $payload['stop_price'];
        $this->size = (float) $payload['size'];
        $this->funds = (float) $payload['funds'];
        $this->private = (bool) $payload['private'];
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getProfileId(): string
    {
        return $this->profileId;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getStopType(): string
    {
        return $this->stopType;
    }

    public function getStopPrice(): float
    {
        return $this->stopPrice;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function getFunds(): float
    {
        return $this->funds;
    }

    public function isPrivate(): bool
    {
        return $this->private;
    }
}
