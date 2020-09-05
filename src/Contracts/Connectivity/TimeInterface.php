<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\TimeDataInterface;

interface TimeInterface
{
    /**
     * Time
    This endpoint does not require authentication.
    Get the API server time.

    HTTP REQUEST
    GET /time

    EPOCH
    The epoch field represents decimal seconds since Unix Epoch
     * @return TimeDataInterface
     */
    public function getTime(): TimeDataInterface;
}
