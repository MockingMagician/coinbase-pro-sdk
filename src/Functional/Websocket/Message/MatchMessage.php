<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

class MatchMessage extends AbstractFullChannelMessage
{
    /**
     * @var int
     */
    private $tradeId;

    /**
     * @var string
     */
    private $makerOrderId;

    /**
     * @var string
     */
    private $takerOrderId;

    /**
     * @var float
     */
    private $size;
    /**
     * @var int
     */
    private $sequence;
    /**
     * @var float
     */
    private $price;
    /**
     * @var null|string
     */
    private $userId;
    /**
     * @var null|string
     */
    private $profileId;
    /**
     * @var null|string
     */
    private $takerUserId;
    /**
     * @var null|string
     */
    private $takerProfileId;
    /**
     * @var null|float
     */
    private $takerFeeRate;
    /**
     * @var null|string
     */
    private $makerUserId;
    /**
     * @var null|string
     */
    private $makerProfileId;
    /**
     * @var null|float
     */
    private $makerFeeRate;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->tradeId = (int) $payload['trade_id'];
        $this->sequence = (int) $payload['trade_id'];
        $this->makerOrderId = $payload['maker_order_id'];
        $this->takerOrderId = $payload['taker_order_id'];
        $this->size = (float) $payload['size'];
        $this->price = (float) $payload['price'];
        $this->userId = $payload['user_id'] ?? null;
        $this->profileId = $payload['profile_id'] ?? null;
        $this->takerUserId = $payload['taker_user_id'] ?? null;
        $this->takerProfileId = $payload['taker_profile_id'] ?? null;
        $this->takerFeeRate = isset($payload['taker_fee_rate']) ? (float) $payload['taker_fee_rate'] : null;
        $this->makerUserId = $payload['maker_user_id'] ?? null;
        $this->makerProfileId = $payload['maker_profile_id'] ?? null;
        $this->makerFeeRate = isset($payload['maker_fee_rate']) ? (float) $payload['maker_fee_rate'] : null;
    }

    public function getTradeId(): int
    {
        return $this->tradeId;
    }

    public function getMakerOrderId(): string
    {
        return $this->makerOrderId;
    }

    public function getTakerOrderId(): string
    {
        return $this->takerOrderId;
    }

    public function getSize(): float
    {
        return $this->size;
    }
}
