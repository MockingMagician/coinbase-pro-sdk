<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

use DateTimeImmutable;

class AbstractFullChannelMessage extends AbstractMessage
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

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->side = $payload['side'];
        $this->productId = $payload['product_id'];
        if (isset($payload['time'])) {
            $this->time = new DateTimeImmutable($payload['time']);
        } else {
            $time = new \DateTime();
            $time->setTimezone(new \DateTimeZone('Z'))->setTimestamp($payload['timestamp']);
            $this->time = DateTimeImmutable::createFromMutable($time);
        }
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
}
