<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\Request;


interface RequestReporterAwareInterface
{
    public function inviteReporter(RequestReporterInterface $requestInspector): void;
}
