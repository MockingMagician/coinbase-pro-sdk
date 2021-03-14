<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

class MatchMessage extends AbstractMORDMessage
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

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->tradeId = (int) $payload['trade_id'];
        $this->makerOrderId = $payload['maker_order_id'];
        $this->takerOrderId = $payload['taker_order_id'];
        $this->size = (float) $payload['size'];
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
