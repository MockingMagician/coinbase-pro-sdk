<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface CurrencyInfoData.
 */
interface CurrencyDataInterface
{
    /**
     * @TODO Highlander thing. message or message_status, only one should/must survive ? May be not...
     * @TODO In case of websocket, it is message_status, in case of API it is message.
     * @TODO So deal with both and merge in one field, statusMessage is more explicit.
     */
    const FIELDS = ['id', 'name', 'min_size', 'status', 'message', 'status_message', 'max_precision', 'details'];

    public function getId(): string;

    public function getName(): string;

    public function getMinSize(): float;

    public function getStatus(): ?string;

    public function getStatusMessage(): ?string;

    public function getMaxPrecision(): ?float;

    public function getDetails(): array;

    public function getExtraData(): array;
}
