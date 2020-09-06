<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface AccountDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts
 *
 * ACCOUNT FIELDS
 *
 * Field	       = Description
 * id	           = Account ID
 * currency	       = the currency of the account
 * balance	       = total funds in the account
 * holds	       = funds on hold (not available for use)
 * available       = funds available to withdraw or trade
 * trading_enabled = is trading enabled for this account?
 *
 * FUNDS ON HOLD
 *
 * When you place an order, the funds for the order are placed on hold.
 * They cannot be used for other orders or withdrawn.
 * Funds will remain on hold until the order is filled or canceled.
 */
interface AccountDataInterface
{
    public function getId(): string;
    public function getCurrency(): string;
    public function getBalance(): float;
    public function getHoldFunds(): float;
    public function getAvailableFunds(): float;
    public function isTradingEnabled(): bool;
    public function getProfileId(): string;
}
