<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

class DoneMessage extends OpenMessage
{
    /**
     * @var string
     */
    private $reason;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->reason = $payload['reason'];
    }

    public function getReason(): string
    {
        return $this->reason;
    }
}
