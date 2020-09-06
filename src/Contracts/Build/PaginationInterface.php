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

    public function setDirection(string $direction): void;
    public function setOffset(string $offset): void;
    public function setLimit(int $limit): void;
    public function getDirection(): ?string;
    public function getOffset(): ?string;
    public function getLimit(): int;
    public function getURI(): string;
}
