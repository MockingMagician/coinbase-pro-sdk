<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Build;


use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class Pagination implements PaginationInterface
{
    /**
     * @var string|null
     */
    private $direction;
    /**
     * @var string|null
     */
    private $offset;
    /**
     * @var int
     */
    private $limit;

    public function __construct(string $direction = null, string $offsetAfterOrBeforeDependingOnDirection = null, int $limit = self::LIMIT)
    {
        if ($direction) {
            $this->setDirection($direction);
        }

        $this->offset = $offsetAfterOrBeforeDependingOnDirection;
        $this->setLimit($limit);
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setDirection(?string $direction): void
    {
        if (!in_array($direction, self::DIRECTIONS)) {
            throw new ApiError(sprintf(
                'Direction in pagination must be one of : %s',
                implode(', ', self::DIRECTIONS)
            ));
        }

        $this->direction = $direction;
    }

    public function getOffset(): ?string
    {
        return $this->offset;
    }

    public function setOffset(?string $offset): void
    {
        $this->offset = $offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): void
    {
        if ($limit < 1 || $limit > self::LIMIT) {
            throw new ApiError(sprintf(
                'Limit in pagination must be an integer between %s and %s',
                1,
                self::LIMIT
            ));
        }

        $this->limit = $limit;
    }

    public function getURI(): string
    {
        $uri = [];
        if ($this->direction && $this->offset) {
            $uri[] = $this->direction . '=' . $this->offset;
        }
        $uri[] = 'limit=' . $this->limit;

        return implode('&', $uri);
    }
}
