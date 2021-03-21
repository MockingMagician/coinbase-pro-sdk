<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Request;

use MockingMagician\CoinbaseProSdk\Contracts\Api\Config\ParamsAwareInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;

interface RequestFactoryInterface extends ParamsAwareInterface
{
    public function createRequest(
        string $method,
        string $routePath,
        array $queryArgs = [],
        ?string $body = null,
        ?PaginationInterface $pagination = null,
        bool $mustBeSigned = true
    ): RequestInterface;
}
