<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\LimitsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\LimitsDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\LimitsData;

class Limits extends AbstractRequestFactoryAware implements LimitsInterface
{
    public function getCurrentExchangeLimitsRaw(): string
    {
        return $this->getRequestFactory()->createRequest('GET', '/users/self/exchange-limits')->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentExchangeLimits(): LimitsDataInterface
    {
        return LimitsData::createFromJson($this->getCurrentExchangeLimitsRaw());
    }
}
