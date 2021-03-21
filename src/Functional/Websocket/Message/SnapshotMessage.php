<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

use MockingMagician\CoinbaseProSdk\Functional\DTO\SnapshotAsk;
use MockingMagician\CoinbaseProSdk\Functional\DTO\SnapshotBid;

class SnapshotMessage extends AbstractMessage
{
    /**
     * @var string
     */
    private $productId;
    /**
     * @var SnapshotAsk[]
     */
    private $asks;
    /**
     * @var SnapshotBid[]
     */
    private $bids;

    public function __construct(array $payload)
    {
        parent::__construct($payload);

        $this->productId = $payload['product_id'];
        $this->asks = [];
        $this->bids = [];

        foreach ($payload['asks'] as $ask) {
            $this->asks[] = SnapshotAsk::createFromArray($ask);
        }

        foreach ($payload['bids'] as $bid) {
            $this->bids[] = SnapshotBid::createFromArray($bid);
        }
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @return SnapshotAsk[]
     */
    public function getAsks(): array
    {
        return $this->asks;
    }

    /**
     * @return SnapshotBid[]
     */
    public function getBids(): array
    {
        return $this->bids;
    }
}
