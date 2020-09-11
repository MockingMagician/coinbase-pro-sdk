<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\MarginInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\BuyingPowerDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\LiquidationHistoryDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\LiquidationStrategyDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\MarginProfileDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\MarginStatusDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PositionRefreshAmountsData;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\WithdrawalPowerDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\RequestManagerInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\MarginStatus;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

/**
 * Class Margin
 * @package MockingMagician\CoinbaseProSdk\Functional\Connectivity
 *
 * @warning Margin api is not yet eligible to consume for now. Do not call any methods except getStatus() to check eligibility
 */
class MarginApiReadyCheckDecorator extends AbstractRequestManagerAware implements MarginInterface
{
    /**
     * @var Margin
     */
    private $margin;

    public function __construct(Margin $margin)
    {
        $this->margin = $margin;
    }

    protected function getRequestManager(): RequestManagerInterface
    {
        return $this->margin->getRequestManager();
    }

    /**
     * @inheritDoc
     */
    public function getMarginProfileInformation(string $productId): MarginProfileDataInterface
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError('Margin api is not yet available and enabled');
        }

        return $this->margin->getMarginProfileInformation();
    }

    /**
     * @inheritDoc
     */
    public function getBuyingPower(string $productId): BuyingPowerDataInterface
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError('Margin api is not yet available and enabled');
        }

        return $this->margin->getBuyingPower($productId);
    }

    /**
     * @inheritDoc
     */
    public function getWithdrawalPower(string $currency): WithdrawalPowerDataInterface
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError('Margin api is not yet available and enabled');
        }

        return $this->margin->getWithdrawalPower($currency);
    }

    /**
     * @inheritDoc
     */
    public function getAllWithdrawalPowers()
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError('Margin api is not yet available and enabled');
        }

        return $this->margin->getAllWithdrawalPowers();
    }

    /**
     * @inheritDoc
     */
    public function getExitPlan(): LiquidationStrategyDataInterface
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError('Margin api is not yet available and enabled');
        }

        return $this->margin->getExitPlan();
    }

    /**
     * @inheritDoc
     */
    public function listLiquidationHistory(?DateTimeInterface $after = null): array
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError('Margin api is not yet available and enabled');
        }

        return $this->margin->listLiquidationHistory($after);
    }

    /**
     * @inheritDoc
     */
    public function getPositionsRefreshAmount(): PositionRefreshAmountsData
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError('Margin api is not yet available and enabled');
        }

        return $this->margin->getPositionsRefreshAmount();
    }

    /**
     * @inheritDoc
     */
    public function getMarginStatus(): MarginStatusDataInterface
    {
        return $this->margin->getMarginStatus();
    }

    private function isMarginReadyToUse(): bool
    {
        $status = $this->margin->getMarginStatus();

        return $status->isEligible() && $status->isEnabled();
    }
}
