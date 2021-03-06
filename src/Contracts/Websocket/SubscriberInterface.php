<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Websocket;


interface SubscriberInterface
{
    public const AUTHENTICATION_LIKE_METHOD = 'GET';
    public const AUTHENTICATION_LIKE_URI = '/users/self/verify';

    public function runWithAuthentication(bool $bool, bool $useCoinbaseRemoteTime = false): void;
    public function setProducts(array $productIds): void;
    public function activeChannelHearBeat(array $productIds): void;
    public function activeChannelStatus(): void;
    public function activeChannelTicker(array $productIds): void;
    public function activeChannelLevel2(array $productIds): void;
    public function activeUserChannel(): void;
    public function activeFullChannel(): void;

    public function getJsonDescription(): string;
}
