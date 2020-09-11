<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity;

use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Products;

/**
 * @internal
 * @coversNothing
 */
class MarginTest extends MarginStatusTest
{
    /**
     * @var Products
     */
    private $products;

    public function setUp(): void
    {
        parent::setUp();
        $this->products = new Products($this->requestManager);

        $status = $this->margin->getMarginStatus();

        if (!$status->isEnabled() || !$status->isEligible()) {
            $this->markTestSkipped('Can not test Margin because margin APi is  not enabled or ineligible');
        }
    }

    public function testGetMarginProfileInformationRaw()
    {
        $this->markTestIncomplete(
            'Data is missing for tests'
        );
        $products = $this->products->getProducts();
        foreach ($products as $product) {
            $raw = $this->margin->getMarginProfileInformationRaw($product->getId());
            var_dump($raw);
        }
    }

    public function testGetBuyingPowerRaw()
    {
        $this->markTestIncomplete(
            'Api endpoint return Internal server error'
        );
        $products = $this->products->getProducts();
        foreach ($products as $product) {
            $raw = $this->margin->getBuyingPowerRaw($product->getId());
            var_dump($raw);
        }
    }

    public function testGetWithdrawalPowerRaw()
    {
        $this->markTestIncomplete(
            'Data is missing for tests'
        );
        $raw = $this->margin->getWithdrawalPowerRaw('USD');
        var_dump($raw);
    }

    public function testGetAllWithdrawalPowersRaw()
    {
        $this->markTestIncomplete(
            'Data is missing for tests'
        );
        $raw = $this->margin->getAllWithdrawalPowersRaw();
        var_dump($raw);
    }

    public function testGetExitPlanRaw()
    {
        $this->markTestIncomplete(
            'Api endpoint return Internal server error'
        );
        $raw = $this->margin->getExitPlanRaw();
        var_dump($raw);
    }

    public function testListLiquidationHistoryRaw()
    {
        $this->markTestIncomplete(
            'Api endpoint return Internal server error'
        );
        $raw = $this->margin->listLiquidationHistoryRaw();
        var_dump($raw);
    }

    public function testGetPositionsRefreshAmountRaw()
    {
        $this->markTestIncomplete(
            'Api endpoint return Internal server error'
        );
        $raw = $this->margin->getPositionsRefreshAmountRaw();
        var_dump($raw);
    }
}
