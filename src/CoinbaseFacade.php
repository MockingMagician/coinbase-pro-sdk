<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk;

use MockingMagician\CoinbaseProSdk\Functional\Api\CoinbaseApi;
use MockingMagician\CoinbaseProSdk\Functional\Api\Config\CoinbaseConfig;
use MockingMagician\CoinbaseProSdk\Functional\Build\LimitOrderToPlace;
use MockingMagician\CoinbaseProSdk\Functional\Build\MarketOrderToPlace;
use MockingMagician\CoinbaseProSdk\Functional\Build\Pagination;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Websocket;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\WebsocketRunner;

/**
 * @codeCoverageIgnore
 */
final class CoinbaseFacade
{
    public static function createDefaultCoinbaseApi(
        string $endpoint,
        string $key,
        string $secret,
        string $passphrase
    ): CoinbaseApi {
        return new CoinbaseApi(CoinbaseConfig::createDefault($endpoint, $key, $secret, $passphrase));
    }

    public static function createCoinbaseApiFromYaml(string $pathToYamlConfig): CoinbaseApi
    {
        return new CoinbaseApi(CoinbaseConfig::createFromYaml($pathToYamlConfig));
    }

    public static function createDefaultCoinbaseConfig(
        string $endpoint,
        string $key,
        string $secret,
        string $passphrase
    ): CoinbaseConfig {
        return CoinbaseConfig::createDefault($endpoint, $key, $secret, $passphrase);
    }

    public static function createCoinbaseConfigWithAllConnectivityDisabled(
        string $endpoint,
        string $key,
        string $secret,
        string $passphrase
    ): CoinbaseApi {
        return new CoinbaseApi(CoinbaseConfig::createWithAllConnectivityDisabled($endpoint, $key, $secret, $passphrase));
    }

    public static function createCoinbaseApi(CoinbaseConfig $coinbaseConfig): CoinbaseApi
    {
        return new CoinbaseApi($coinbaseConfig);
    }

    public static function createPagination(
        string $direction = Pagination::DIRECTION_DESC,
        ?string $offsetAfterOrBeforeDependingOnDirection = null,
        int $limit = Pagination::LIMIT
    ): Pagination {
        return new Pagination($direction, $offsetAfterOrBeforeDependingOnDirection, $limit);
    }

    public static function createLimitOrderToPlace(
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
    ): LimitOrderToPlace {
        return new LimitOrderToPlace(
            $side,
            $productId,
            $price,
            $size,
            $timeInForce,
            $cancelAfter,
            $postOnly,
            $selfTradePrevention,
            $stop,
            $stopPrice,
            $clientOrderId
        );
    }

    public static function createMarketOrderToPlace(
        string $side,
        string $productId,
        ?float $size = null,
        ?float $funds = null,
        ?string $selfTradePrevention = null,
        ?string $stop = null,
        ?float $stopPrice = null,
        ?string $clientOrderId = null
    ): MarketOrderToPlace {
        return new MarketOrderToPlace(
            $side,
            $productId,
            $size,
            $funds,
            $selfTradePrevention,
            $stop,
            $stopPrice,
            $clientOrderId
        );
    }

    public static function createUnauthenticatedWebsocket(): Websocket
    {
        return new Websocket(new WebsocketRunner());
    }
}
