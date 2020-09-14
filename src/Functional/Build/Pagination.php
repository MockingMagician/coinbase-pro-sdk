<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Build;

use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class Pagination implements PaginationInterface
{
    /**
     * @var null|string
     */
    private $direction;
    /**
     * @var null|string
     */
    private $offset;
    /**
     * @var int
     */
    private $limit;
    /**
     * @var bool
     */
    private $hasNext = true;

    public function __construct(string $direction = self::DIRECTION_DESC, string $offsetAfterOrBeforeDependingOnDirection = null, int $limit = self::LIMIT)
    {

        $this->setDirection($direction);

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

    public function getQueryArgs(): array
    {
        $args = [];
        if ($this->direction && $this->offset) {
            $args[self::DIRECTIONS_QUERY_NAMING[$this->direction]] = $this->offset;
        }
        $args['limit'] = $this->limit;

        return $args;
    }

    public function hasNext(): bool
    {
        return $this->hasNext;
    }

    public function setHasNext(bool $hasNext)
    {
        $this->hasNext = $hasNext;
    }
}
