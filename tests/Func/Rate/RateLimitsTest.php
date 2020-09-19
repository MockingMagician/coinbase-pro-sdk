<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Rate;

use MockingMagician\CoinbaseProSdk\Contracts\ApiConnectivityInterface;
use MockingMagician\CoinbaseProSdk\Functional\ApiFactory;
use MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity\AbstractTest;
use React\EventLoop\Factory;

/**
 * @internal
 */
class RateLimitsTest extends AbstractTest
{
    /**
     * @var ApiConnectivityInterface
     */
    private $api;

    public function setUp(): void
    {
        parent::setUp();
        $this->api = ApiFactory::createFull(
            $this->apiParams->getEndPoint(),
            $this->apiParams->getKey(),
            $this->apiParams->getSecret(),
            $this->apiParams->getPassphrase(),
            false,
            false
        );
    }

    public function callApi($self, $product)
    {
        $self->api->products()->getProductTicker($product->getId());
        $self->api->currencies()->getCurrencies();

        $time = microtime(true);
        dump($time);

        yield $time;
    }

    public function testToFailPublic()
    {
        $products = $this->api->products()->getProducts();
        $loop = Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $loop->addPeriodicTimer(0, function () use ($products) {
                foreach ($products as $product) {
                    dump(microtime(true));
                    $this->api->products()->getProductTicker($product->getId());
                    $this->api->currencies()->getCurrencies();
                }
            });
        }
        $loop->run();

//        $pool = Pool::create();
//        foreach ($products as $product) {
//            dump($product->getId());
//            $pool[] =
//                async(function () use ($product) {
////                    sleep(5);
//                    $this->api->products()->getProductTicker($product->getId());
//                    $this->api->currencies()->getCurrencies();
//
//                    return true;
//                })->then(function () {
//                    dump(microtime(true));
//                })->catch(function (\Throwable $e) {
//                    throw $e;
//                });
//        }
//
//        $pool->wait();
    }

}
