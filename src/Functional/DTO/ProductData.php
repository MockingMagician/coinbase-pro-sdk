<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\ProductDataInterface;

class ProductData implements ProductDataInterface
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
    private $tradingEnabled;

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
        bool $tradingEnabled
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
        $this->tradingEnabled = $tradingEnabled;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @return string
     */
    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    /**
     * @return string
     */
    public function getQuoteCurrency(): string
    {
        return $this->quoteCurrency;
    }

    /**
     * @return float
     */
    public function getBaseIncrement(): float
    {
        return $this->baseIncrement;
    }

    /**
     * @return float
     */
    public function getQuoteIncrement(): float
    {
        return $this->quoteIncrement;
    }

    /**
     * @return float
     */
    public function getBaseMinSize(): float
    {
        return $this->baseMinSize;
    }

    /**
     * @return float
     */
    public function getBaseMaxSize(): float
    {
        return $this->baseMaxSize;
    }

    /**
     * @return float
     */
    public function getMinMarketFunds(): float
    {
        return $this->minMarketFunds;
    }

    /**
     * @return float
     */
    public function getMaxMarketFunds(): float
    {
        return $this->maxMarketFunds;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getStatusMessage(): string
    {
        return $this->statusMessage;
    }

    /**
     * @return bool
     */
    public function isCancelOnly(): bool
    {
        return $this->cancelOnly;
    }

    /**
     * @return bool
     */
    public function isLimitOnly(): bool
    {
        return $this->limitOnly;
    }

    /**
     * @return bool
     */
    public function isPostOnly(): bool
    {
        return $this->postOnly;
    }

    /**
     * @return bool
     */
    public function isTradingEnabled(): bool
    {
        return $this->tradingEnabled;
    }

    public static function createFromArray(array $array) {
        return new self(
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
            $array['trading_disabled'],
        );
    }

    public static function createFromJson(string $json) {
        return self::createFromArray(json_decode($json, true));
    }

    public static function createCollectionFromJson(string $json) {
        $collection = json_decode($json, true);
        foreach ($collection as $k => $v) {
            $collection[$k] = self::createFromArray($v);
        }
        return $collection;
    }
}
