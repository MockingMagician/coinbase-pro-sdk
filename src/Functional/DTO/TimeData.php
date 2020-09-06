<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\TimeDataInterface;

class TimeData implements TimeDataInterface
{
    private $iso;
    private $epoch;

    public function __construct(string $body)
    {
        $body = json_decode($body, true);
        $this->iso = $body['iso'];
        $this->epoch = (float) $body['epoch'];
    }

    public function getIso(): string
    {
        return $this->iso;
    }

    public function getEpoch(): float
    {
        return $this->epoch;
    }
}
