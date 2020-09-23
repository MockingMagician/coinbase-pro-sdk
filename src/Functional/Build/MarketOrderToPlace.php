<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Build;

use MockingMagician\CoinbaseProSdk\Contracts\Build\MarketOrderToPlaceInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class MarketOrderToPlace extends AbstractCommonOrderToPlace implements MarketOrderToPlaceInterface
{
    /**
     * @var null|float
     */
    private $size;
    /**
     * @var null|float
     */
    private $funds;

    public function __construct(
        string $side,
        string $productId,
        ?float $size = null,
        ?float $funds = null,
        ?string $selfTradePrevention = null,
        ?string $stop = null,
        ?float $stopPrice = null,
        ?string $clientOrderId = null
    ) {
        $type = self::TYPE_MARKET;

        if (($size && $funds) || (!$size && !$funds)) {
            throw new ApiError('Only one of size or funds is required. Size is for desired amount in base currency; Funds for desired amount of quote currency to use');
        }

        parent::__construct($type, $side, $productId, $selfTradePrevention, $stop, $stopPrice, $clientOrderId);
        $this->size = $size;
        $this->funds = $funds;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function getFunds(): ?float
    {
        return $this->funds;
    }

    public function getBodyForRequest(): array
    {
        $body = parent::getBodyForRequest();

        if ($this->size) {
            $body['size'] = $this->size;
        } else {
            $body['funds'] = $this->funds;
        }

        return $body;
    }
}
