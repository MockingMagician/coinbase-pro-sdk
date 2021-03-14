<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

class ErrorMessage extends AbstractMessage
{
    private $type;
    private $message;
    private $reason;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->type = $payload['type'];
        $this->message = $payload['message'];
        $this->reason = $payload['reason'] ?? null;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }
}
