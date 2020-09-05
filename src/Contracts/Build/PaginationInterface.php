<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Build;


interface PaginationInterface
{
    const HEADER_AFTER = 'CB-AFTER';
    const HEADER_BEFORE = 'CB-BEFORE';
    const HEADERS = [
        self::HEADER_AFTER,
        self::HEADER_BEFORE,
    ];

    const AFTER = 'after';
    const BEFORE = 'before';
    const LIMIT = 100;

    const DIRECTIONS = [
        self::AFTER,
        self::BEFORE,
    ];

    /**
     * @param string|null $direction null if first pagination from beginning
     * @param string|null $offsetAfterOrBeforeDependingOnDirection null if first pagination from beginning
     * @param int $limit
     * @return PaginationInterface
     */
    public static function getNew(
        string $direction = null,
        string $offsetAfterOrBeforeDependingOnDirection = null,
        int $limit = self::LIMIT
    ): PaginationInterface;

    public function getNext(string $after, int $limit = self::LIMIT): PaginationInterface;

    public function getPrevious(string $before, int $limit = self::LIMIT): PaginationInterface;
}
