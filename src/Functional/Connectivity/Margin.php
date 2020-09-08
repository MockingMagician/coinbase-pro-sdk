<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\MarginInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\BuyingPowerDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\LiquidationStrategyDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\MarginProfileDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\MarginStatusData;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PositionRefreshAmountsData;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\WithdrawalPowerDataInterface;

// TODO after products implement
class Margin extends AbstractRequestManagerAware implements MarginInterface
{
    /**
     * @inheritDoc
     */
    public function getMarginProfileInformation(string $productId): MarginProfileDataInterface
    {
        // TODO: Implement getMarginProfileInformation() method.
    }

    /**
     * @inheritDoc
     */
    public function getBuyingPower(string $productId): BuyingPowerDataInterface
    {
        // TODO: Implement getBuyingPower() method.
    }

    /**
     * @inheritDoc
     */
    public function getWithdrawalPower(string $currency): WithdrawalPowerDataInterface
    {
        // TODO: Implement getWithdrawalPower() method.
    }

    /**
     * @inheritDoc
     */
    public function getAllWithdrawalPowers(string $currency): array
    {
        // TODO: Implement getAllWithdrawalPowers() method.
    }

    /**
     * @inheritDoc
     */
    public function getExitPlan(): LiquidationStrategyDataInterface
    {
        // TODO: Implement getExitPlan() method.
    }

    /**
     * @inheritDoc
     */
    public function listLiquidationHistory(): array
    {
        // TODO: Implement listLiquidationHistory() method.
    }

    /**
     * @inheritDoc
     */
    public function getPositionsRefreshAmount(): PositionRefreshAmountsData
    {
        // TODO: Implement getPositionsRefreshAmount() method.
    }

    /**
     * @inheritDoc
     */
    public function getMarginStatus(): MarginStatusData
    {
        // TODO: Implement getMarginStatus() method.
    }
}
