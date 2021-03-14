<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

use DateTimeImmutable;

/**
 * Class AbstractMORDMessage.
 *
 * "side" => "buy" --
 * "product_id" => "XLM-EUR" --
 * "time" => "2021-03-14T00:08:20.048193Z" --
 * "sequence" => 1942667821 --
 * "price" => "0.333754" --
 */
class AbstractMORDMessage extends AbstractMessage
{
    /**
     * @var string
     */
    private $side;

    /**
     * @var string
     */
    private $productId;

    /**
     * @var DateTimeImmutable
     */
    private $time;

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
        $this->side = $payload['side'];
        $this->productId = $payload['product_id'];
        $this->time = new DateTimeImmutable($payload['time']);
        $this->sequence = (int) $payload['sequence'];
        $this->price = $payload['price'] ? (float) $payload['price'] : null;
    }

    public function getSide(): string
    {
        return $this->side;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getTime(): DateTimeImmutable
    {
        return $this->time;
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
