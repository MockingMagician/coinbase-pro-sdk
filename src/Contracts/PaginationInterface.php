<?php


namespace MockingMagician\CoinbaseProSdk\Contracts;


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
}
