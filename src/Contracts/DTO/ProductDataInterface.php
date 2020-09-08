<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface ProductDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * [
 * {
 * "id": "BTC-USD",
 * "display_name": "BTC/USD",
 * "base_currency": "BTC",
 * "quote_currency": "USD",
 * "base_increment": "0.00000001",
 * "quote_increment": "0.01000000",
 * "base_min_size": "0.00100000",
 * "base_max_size": "280.00000000",
 * "min_market_funds": "5",
 * "max_market_funds": "1000000",
 * "status": "online",
 * "status_message": "",
 * "cancel_only": false,
 * "limit_only": false,
 * "post_only": false,
 * "trading_disabled": false
 * },
 * ...
 * ]
 */
interface ProductDataInterface
{
    public function getId(): string;
    public function getDisplayName(): string;
    public function getBaseCurrency(): string;
    public function getQuoteCurrency(): string;
    public function getBaseIncrement(): float;
    public function getQuoteIncrement(): float;
    public function getBaseMinSize(): float;
    public function getBaseMaxSize(): float;
    public function getMinMarketFunds(): float;
    public function getMaxMarketFunds(): float;
    public function getStatus(): string;
    public function getStatusMessage(): string;
    public function isCancelOnly(): bool;
    public function isLimitOnly(): bool;
    public function isPostOnly(): bool;
    public function isTradingEnabled(): bool;

}
