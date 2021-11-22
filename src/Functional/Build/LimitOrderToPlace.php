<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Build;

use MockingMagician\CoinbaseProSdk\Contracts\Build\LimitOrderInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class LimitOrderToPlace extends AbstractOrder implements LimitOrderInterface
{
    /**
     * @var float
     */
    private $price;
    /**
     * @var float
     */
    private $size;
    /**
     * @var null|string
     */
    private $timeInForce;
    /**
     * @var null|string
     */
    private $cancelAfter;
    /**
     * @var bool
     */
    private $postOnly;

    public function __construct(
        string $side,
        string $productId,
        float $price,
        float $size,
        ?string $timeInForce = null,
        ?string $cancelAfter = null,
        bool $postOnly = false,
        ?string $selfTradePrevention = null,
        ?string $stop = null,
        ?float $stopPrice = null,
        ?string $clientOrderId = null
    ) {
        $type = self::TYPE_LIMIT;
        parent::__construct($type, $side, $productId, $selfTradePrevention, $stop, $stopPrice, $clientOrderId);

        if ($postOnly && in_array($timeInForce, [self::TIME_IN_FORCE_IMMEDIATE_OR_CANCEL, self::TIME_IN_FORCE_FILL_OR_KILL])) {
            throw new ApiError(sprintf(
                'postOnly is invalid with timeInForce values : %s',
                implode(', ', [self::TIME_IN_FORCE_IMMEDIATE_OR_CANCEL, self::TIME_IN_FORCE_FILL_OR_KILL])
            ));
        }

        if ($cancelAfter && !in_array($cancelAfter, self::CANCELS_AFTER)) {
            throw new ApiError(sprintf('cancelAfter must be one of : %s', implode(', ', self::CANCELS_AFTER)));
        }

        if ($cancelAfter && self::TIME_IN_FORCE_GOOD_TILL_TIME !== $timeInForce) {
            throw new ApiError(sprintf(
                'When cancelAfter is set, timeInForce must be set to %s',
                self::TIME_IN_FORCE_GOOD_TILL_TIME
            ));
        }

        $this->price = $price;
        $this->size = $size;
        $this->timeInForce = $timeInForce;
        $this->cancelAfter = $cancelAfter;
        $this->postOnly = $postOnly;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function getTimeInForce(): ?string
    {
        return $this->timeInForce;
    }

    public function getCancelAfter(): ?string
    {
        return $this->cancelAfter;
    }

    public function isPostOnly(): bool
    {
        return $this->postOnly;
    }

    public function getBodyForRequest(): array
    {
        $body = parent::getBodyForRequest();

        $body['price'] = $this->price;
        $body['size'] = $this->size;

        if ($this->timeInForce) {
            $body['time_in_force'] = $this->timeInForce;
        }

        if ($this->cancelAfter) {
            $body['cancel_after'] = $this->cancelAfter;
        }

        if ($this->postOnly) {
            $body['post_only'] = $this->postOnly;
        }

        return $body;
    }
}
