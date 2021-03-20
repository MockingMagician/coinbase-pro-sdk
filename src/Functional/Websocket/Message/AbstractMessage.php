<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

use MockingMagician\CoinbaseProSdk\Contracts\Websocket\MessageInterface;

abstract class AbstractMessage implements MessageInterface
{
    /**
     * @var array
     */
    private $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}
