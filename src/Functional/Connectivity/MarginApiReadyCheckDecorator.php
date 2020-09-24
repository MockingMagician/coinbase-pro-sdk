<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\MarginInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\BuyingPowerDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\LiquidationStrategyDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\MarginProfileDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\MarginStatusDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PositionRefreshAmountsData;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\WithdrawalPowerDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\RequestFactoryInterface;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

/**
 * Class Margin.
 *
 * @codeCoverageIgnore
 * @warning Margin api is not yet eligible to consume for now. Do not call any methods except getStatus() to check eligibility
 */
class MarginApiReadyCheckDecorator extends AbstractRequestManagerAware implements MarginInterface
{
    const ERROR_MESSAGE = 'Margin api is not yet available and enabled';

    /**
     * @var Margin
     */
    private $margin;

    public function __construct(Margin $margin)
    {
        $this->margin = $margin;
    }

    /**
     * {@inheritdoc}
     */
    public function getMarginProfileInformation(string $productId): MarginProfileDataInterface
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError(self::ERROR_MESSAGE);
        }

        return $this->margin->getMarginProfileInformation($productId);
    }

    /**
     * {@inheritdoc}
     */
    public function getBuyingPower(string $productId): BuyingPowerDataInterface
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError(self::ERROR_MESSAGE);
        }

        return $this->margin->getBuyingPower($productId);
    }

    /**
     * {@inheritdoc}
     */
    public function getWithdrawalPower(string $currency): WithdrawalPowerDataInterface
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError(self::ERROR_MESSAGE);
        }

        return $this->margin->getWithdrawalPower($currency);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllWithdrawalPowers()
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError(self::ERROR_MESSAGE);
        }

        return $this->margin->getAllWithdrawalPowers();
    }

    /**
     * {@inheritdoc}
     */
    public function getExitPlan(): LiquidationStrategyDataInterface
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError(self::ERROR_MESSAGE);
        }

        return $this->margin->getExitPlan();
    }

    /**
     * {@inheritdoc}
     */
    public function listLiquidationHistory(?DateTimeInterface $after = null): array
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError(self::ERROR_MESSAGE);
        }

        return $this->margin->listLiquidationHistory($after);
    }

    /**
     * {@inheritdoc}
     */
    public function getPositionsRefreshAmount(): PositionRefreshAmountsData
    {
        if (!$this->isMarginReadyToUse()) {
            throw new ApiError(self::ERROR_MESSAGE);
        }

        return $this->margin->getPositionsRefreshAmount();
    }

    /**
     * {@inheritdoc}
     */
    public function getMarginStatus(): MarginStatusDataInterface
    {
        return $this->margin->getMarginStatus();
    }

    protected function getRequestManager(): RequestFactoryInterface
    {
        return $this->margin->getRequestManager();
    }

    private function isMarginReadyToUse(): bool
    {
        $status = $this->margin->getMarginStatus();

        return $status->isEligible() && $status->isEnabled();
    }
}
