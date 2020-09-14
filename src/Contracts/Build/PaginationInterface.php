<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Build;

interface PaginationInterface
{
    const HEADER_AFTER = 'Cb-After';
    const HEADER_BEFORE = 'Cb-Before';
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

    public function getQueryArgs(): array;
}
