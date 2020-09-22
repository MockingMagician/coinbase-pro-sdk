<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Build\Rate;


use MockingMagician\CoinbaseProSdk\Contracts\Build\RateLimitsInterface;

class RateLimits implements RateLimitsInterface
{
    /**
     * @var int
     */
    private $limit;
    /**
     * @var float[]
     */
    private $lastCalls = [];

    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    public function recordCallRequest(): void
    {
        $this->lastCalls[] = microtime(true);
        $lastCallLength = count($this->lastCalls);
        if ($lastCallLength <= $this->limit) {
            return;
        }
        $this->lastCalls = array_slice($this->lastCalls, $lastCallLength - $this->limit, $this->limit);
    }

    public function shouldWeWait(): bool
    {
        $lastCallLength = count($this->lastCalls);
        if ($lastCallLength < $this->limit) {
            return false;
        }
        if (microtime(true) - $this->lastCalls[$lastCallLength - 1] >= 1) {
            return false;
        }
        $elapsedTimeBetweenLimit = $this->lastCalls[$lastCallLength - 1] - $this->lastCalls[0];

        return $elapsedTimeBetweenLimit < 1;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
