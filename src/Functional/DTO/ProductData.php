<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProductDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

class ProductData extends AbstractCreator implements ProductDataInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $displayName;
    /**
     * @var string
     */
    private $baseCurrency;
    /**
     * @var string
     */
    private $quoteCurrency;
    /**
     * @var float
     */
    private $baseIncrement;
    /**
     * @var float
     */
    private $quoteIncrement;
    /**
     * @var float
     */
    private $baseMinSize;
    /**
     * @var float
     */
    private $baseMaxSize;
    /**
     * @var float
     */
    private $minMarketFunds;
    /**
     * @var float
     */
    private $maxMarketFunds;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $statusMessage;
    /**
     * @var bool
     */
    private $cancelOnly;
    /**
     * @var bool
     */
    private $limitOnly;
    /**
     * @var bool
     */
    private $postOnly;
    /**
     * @var bool
     */
    private $tradingDisabled;
    /**
     * @var bool
     */
    private $isMarginEnabled;
    /**
     * @var string|null
     */
    private $spot;

    public function __construct(
        string $id,
        string $displayName,
        string $baseCurrency,
        string $quoteCurrency,
        float $baseIncrement,
        float $quoteIncrement,
        float $baseMinSize,
        float $baseMaxSize,
        float $minMarketFunds,
        float $maxMarketFunds,
        string $status,
        string $statusMessage,
        bool $cancelOnly,
        bool $limitOnly,
        bool $postOnly,
        bool $tradingDisabled,
        bool $isMarginEnabled,
        ?string $spot
    ) {
        $this->id = $id;
        $this->displayName = $displayName;
        $this->baseCurrency = $baseCurrency;
        $this->quoteCurrency = $quoteCurrency;
        $this->baseIncrement = $baseIncrement;
        $this->quoteIncrement = $quoteIncrement;
        $this->baseMinSize = $baseMinSize;
        $this->baseMaxSize = $baseMaxSize;
        $this->minMarketFunds = $minMarketFunds;
        $this->maxMarketFunds = $maxMarketFunds;
        $this->status = $status;
        $this->statusMessage = $statusMessage;
        $this->cancelOnly = $cancelOnly;
        $this->limitOnly = $limitOnly;
        $this->postOnly = $postOnly;
        $this->tradingDisabled = $tradingDisabled;
        $this->isMarginEnabled = $isMarginEnabled;
        $this->spot = $spot;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    public function getQuoteCurrency(): string
    {
        return $this->quoteCurrency;
    }

    public function getBaseIncrement(): float
    {
        return $this->baseIncrement;
    }

    public function getQuoteIncrement(): float
    {
        return $this->quoteIncrement;
    }

    public function getBaseMinSize(): float
    {
        return $this->baseMinSize;
    }

    public function getBaseMaxSize(): float
    {
        return $this->baseMaxSize;
    }

    public function getMinMarketFunds(): float
    {
        return $this->minMarketFunds;
    }

    public function getMaxMarketFunds(): float
    {
        return $this->maxMarketFunds;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getStatusMessage(): string
    {
        return $this->statusMessage;
    }

    public function isCancelOnly(): bool
    {
        return $this->cancelOnly;
    }

    public function isLimitOnly(): bool
    {
        return $this->limitOnly;
    }

    public function isPostOnly(): bool
    {
        return $this->postOnly;
    }

    public function isTradingDisabled(): bool
    {
        return $this->tradingDisabled;
    }

    public function isMarginEnabled(): bool
    {
        return $this->isMarginEnabled;
    }

    public function isTradingFullyOperational(): bool
    {
        return
            !(
                $this->isCancelOnly() ||
                $this->isLimitOnly() ||
                $this->isPostOnly() ||
                $this->isTradingDisabled()
            )
        ;
    }

    public function getSpot(): ?string
    {
        return $this->spot;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['id'],
            $array['display_name'],
            $array['base_currency'],
            $array['quote_currency'],
            $array['base_increment'],
            $array['quote_increment'],
            $array['base_min_size'],
            $array['base_max_size'],
            $array['min_market_funds'],
            $array['max_market_funds'],
            $array['status'],
            $array['status_message'],
            $array['cancel_only'],
            $array['limit_only'],
            $array['post_only'],
            $array['trading_disabled'] ?? false,
            $array['margin_enabled'] ?? false,
            $array['spot'] ?? false
        );
    }

    public static function createFromJson(string $json, ...$extraData)
    {
        return self::createFromArray(Json::decode($json, true));
    }
}
