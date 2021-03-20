<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Api\Config;


interface ParamsAwareInterface
{
    public function getParams(): ParamsInterface;
}
