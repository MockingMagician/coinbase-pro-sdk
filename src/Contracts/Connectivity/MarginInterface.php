<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\BuyingPowerDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\LiquidationHistoryDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\LiquidationStrategyDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\MarginProfileDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\MarginStatusDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PositionRefreshAmountsData;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\WithdrawalPowerDataInterface;

interface MarginInterface
{
    /**
     * Get margin profile information
     *
     * Get information about your margin profile, such as your current equity percentage.
     *
     * HTTP REQUEST
     * GET /margin/profile_information
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * QUERY PARAMETERS
     * Param    Default    Description
     * product_id    [required]    The product ID to compute buying/selling/borrow power for.
     * (The products list is available via the /products endpoint.)
     *
     * @param string $productId
     * @return MarginProfileDataInterface
     */
    public function getMarginProfileInformation(string $productId): MarginProfileDataInterface;

    /**
     * Get buying power
     *
     * Get your buying power and selling power for a particular product.
     * For example: On BTC-USD, "buying power" refers to how much USD you can use to buy BTC,
     * and "selling power" refers to how much BTC you can sell for USD.
     *
     * HTTP REQUEST
     * GET /margin/buying_power
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * QUERY PARAMETERS
     * Param    Default    Description
     * product_id    [required]    The product ID to compute buying/selling power for.
     * (The products list is available via the /products endpoint.)
     *
     * @param string $productId
     * @return BuyingPowerDataInterface
     */
    public function getBuyingPower(string $productId): BuyingPowerDataInterface;

    /**
     * Get withdrawal power
     *
     * Returns the max amount of the given currency that you can withdraw from your margin profile.
     *
     * HTTP REQUEST
     * GET /margin/withdrawal_power
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * QUERY PARAMETERS
     * Param    Default    Description
     * currency    [required]    The currency to compute withdrawal power for.
     *
     * @param string $currency
     * @return WithdrawalPowerDataInterface
     */
    public function getWithdrawalPower(string $currency): WithdrawalPowerDataInterface;

    /**
     * Get all withdrawal powers
     *
     * Returns the max amount of each currency that you can withdraw from your margin profile.
     *
     * HTTP REQUEST
     * GET /margin/withdrawal_power_all
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     */
    public function getAllWithdrawalPowers();

    /**
     * Get exit plan
    Returns a liquidation strategy that can be performed to get your equity percentage back to an acceptable level (i.e. your initial equity percentage).

    HTTP REQUEST
    GET /margin/exit_plan

    API KEY PERMISSIONS
    This endpoint requires either the "view" or "trade" permission.
     * @return mixed
     */
    public function getExitPlan(): LiquidationStrategyDataInterface;

    /**
     * List liquidation history
     * Returns a list of liquidations that were performed to get your equity percentage back to an acceptable level.
     *
     * HTTP REQUEST
     * GET /margin/liquidation_history
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * QUERY PARAMETERS
     * Param    Default    Description
     * after    [optional]    Request liquidation history after this date.
     * @param DateTimeInterface $after
     * @return LiquidationHistoryDataInterface[]
     */
    public function listLiquidationHistory(?DateTimeInterface $after = null): array ;

    /**
     * Get position refresh amounts
     *
     * Returns the amount in USD of loans that will be renewed in the next day and then the day after.
     * "twoDayRenewalAmount" is the amount to be refreshed on only the second day.
     *
     * HTTP REQUEST
     * GET /margin/position_refresh_amounts
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * @return PositionRefreshAmountsData
     */
    public function getPositionsRefreshAmount(): PositionRefreshAmountsData;

    /**
     * Get margin status
     *
     * Returns whether margin is currently enabled.
     *
     * HTTP REQUEST
     * GET /margin/status
     *
     * API KEY PERMISSIONS
     * This endpoint requires either the "view" or "trade" permission.
     *
     * @return MarginStatusDataInterface
     */
    public function getMarginStatus(): MarginStatusDataInterface;
}
