<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\Api;

use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\AccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\CoinbaseAccountsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\CurrenciesInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\DepositsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\FeesInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\FillsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\LimitsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\MarginInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\OracleInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\OrdersInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\PaymentMethodsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ProductsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ProfilesInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\ReportsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\StableCoinConversionsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\WithdrawalsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestAwareInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\WebsocketInterface;

interface ApiInterface extends RequestAwareInterface
{
    // Private
    public function accounts(): AccountsInterface;

    public function orders(): OrdersInterface;

    public function fills(): FillsInterface;

    public function limits(): LimitsInterface;

    public function deposits(): DepositsInterface;

    public function withdrawals(): WithdrawalsInterface;

    public function stablecoinConversions(): StableCoinConversionsInterface;

    public function paymentMethods(): PaymentMethodsInterface;

    public function coinbaseAccounts(): CoinbaseAccountsInterface;

    public function fees(): FeesInterface;

    public function reports(): ReportsInterface;

    public function profiles(): ProfilesInterface;

    public function margin(): MarginInterface;

    public function oracle(): OracleInterface;

    // Public
    public function products(): ProductsInterface;

    public function currencies(): CurrenciesInterface;

    public function time(): TimeInterface;

    // Websocket
    public function websocket(): WebsocketInterface;
}
