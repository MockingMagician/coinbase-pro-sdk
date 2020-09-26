<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Request;


interface RequestInspectorAwareInterface
{
    public function inviteInspector(RequestInspectorInterface $requestInspector): void;
}
