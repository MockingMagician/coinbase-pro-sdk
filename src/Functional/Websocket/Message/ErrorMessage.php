<?php


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

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string|null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }
}
