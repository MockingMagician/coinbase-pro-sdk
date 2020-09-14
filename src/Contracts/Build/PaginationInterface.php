<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Build;

/**
 * Interface PaginationInterface
 *
 * Pagination
 *
 * Coinbase Pro uses cursor pagination for all REST requests which return arrays.
 * Cursor pagination allows for fetching results before and after the current page of results and
 * is well suited for realtime data. Endpoints like /trades, /fills, /orders, return the latest items by default.
 * To retrieve more results subsequent requests should specify which direction to paginate based on the data previously returned.
 *
 * before and after cursors are available via response headers CB-BEFORE and CB-AFTER. Your requests should use these cursor values when making requests for pages after the initial request.
 *
 * PARAMETERS
 * Parameter	Default	Description
 * before		Request page before (newer) this pagination id.
 * after		Request page after (older) this pagination id.
 * limit	100	Number of results per request. Maximum 100. (default 100)
 *
 * EXAMPLE
 * GET /orders?before=2&limit=30
 *
 * BEFORE AND AFTER CURSORS
 * The before cursor references the first item in a results page and the after cursor references the last item in a set of results.
 * To request a page of records before the current one, use the before query parameter.
 * Your initial request can omit this parameter to get the default first page.
 * The response will contain a CB-BEFORE header which will return the cursor id to use in your next request for the page before the current one.
 * The page before is a newer page and not one that happened before in chronological time.
 * The response will also contain a CB-AFTER header which will return the cursor id to use in your next request for the page after this one.
 * The page after is an older page and not one that happened after this one in chronological time.
 *
 * Cursor pagination can be unintuitive at first. before and after cursor arguments should not be confused with
 * before and after in chronological time. Most paginated requests return the latest information (newest) as the
 * first page sorted by newest (in chronological time) first.
 * To get older information you would request pages after the initial page.
 * To get information newer, you would request pages before the first page.
 */
interface PaginationInterface
{
    const HEADER_AFTER = 'Cb-After';
    const HEADER_BEFORE = 'Cb-Before';
    const HEADERS = [
        self::HEADER_AFTER,
        self::HEADER_BEFORE,
    ];

    const DIRECTION_DESC = 'desc';
    const DIRECTION_ASC = 'asc';
    const DIRECTIONS = [
        self::DIRECTION_DESC,
        self::DIRECTION_ASC,
    ];

    const DIRECTIONS_QUERY_NAMING = [
        self::DIRECTION_DESC => 'after',
        self::DIRECTION_ASC => 'before',
    ];

    const LIMIT = 100;

    public function setDirection(string $direction): void;

    public function setOffset(string $offset): void;

    public function setLimit(int $limit): void;

    public function getDirection(): ?string;

    public function getOffset(): ?string;

    public function getLimit(): int;

    public function getQueryArgs(): array;

    public function hasNext(): bool;

    public function setHasNext(bool $hasNext);
}
