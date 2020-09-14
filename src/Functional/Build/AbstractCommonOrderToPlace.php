<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Build;

use MockingMagician\CoinbaseProSdk\Contracts\Build\CommonOrderToPlaceInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class AbstractCommonOrderToPlace implements CommonOrderToPlaceInterface
{
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $side;
    /**
     * @var string
     */
    private $productId;
    /**
     * @var null|string
     */
    private $selfTradePrevention;
    /**
     * @var null|string
     */
    private $stop;
    /**
     * @var null|float
     */
    private $stopPrice;
    /**
     * @var null|string
     */
    private $clientOrderId;

    public function __construct(
        string $type,
        string $side,
        string $productId,
        ?string $selfTradePrevention = null,
        ?string $stop = null,
        ?float $stopPrice = null,
        ?string $clientOrderId = null
    ) {
        if (!in_array($type, self::TYPES)) {
            throw new ApiError(sprintf('type must be one of : %s', implode(', ', self::TYPES)));
        }

        if ($selfTradePrevention && !in_array($selfTradePrevention, self::SELF_TRADE_PREVENTIONS)) {
            throw new ApiError(sprintf('selfTradePrevention must be one of : %s', implode(', ', self::SELF_TRADE_PREVENTIONS)));
        }

        if (!is_null($stop) && !in_array($stop, self::STOPS)) {
            throw new ApiError(sprintf('stop must be one of : %s', implode(', ', self::STOPS)));
        }

        $this->type = $type;
        $this->side = $side;
        $this->productId = $productId;
        $this->selfTradePrevention = $selfTradePrevention;
        $this->stop = $stop;
        $this->stopPrice = $stopPrice;
        $this->clientOrderId = $clientOrderId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSide(): string
    {
        return $this->side;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getSelfTradePrevention(): ?string
    {
        return $this->selfTradePrevention;
    }

    public function getStop(): ?string
    {
        return $this->stop;
    }

    public function getStopPrice(): ?float
    {
        return $this->stopPrice;
    }

    public function getClientOrderId(): ?string
    {
        return $this->clientOrderId;
    }

    public function getBodyForRequest(): array
    {
        $body = [
            'type' => $this->type,
            'side' => $this->side,
            'product_id' => $this->productId,
        ];

        if ($this->clientOrderId) {
            $body['client_oid'] = $this->clientOrderId;
        }

        if ($this->selfTradePrevention) {
            $body['stp'] = $this->selfTradePrevention;
        }

        if ($this->stop) {
            $body['stop'] = $this->stop;
        }

        if ($this->stopPrice) {
            $body['stop_price'] = $this->stopPrice;
        }

        return $body;
    }
}
