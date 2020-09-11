<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\CryptoDepositAddressInfoDataInterface;

class CryptoDepositAddressInfoData implements CryptoDepositAddressInfoDataInterface
{
    /**
     * @var string
     */
    private $address;
    /**
     * @var int
     */
    private $destinationTag;

    public function __construct(string $address, int $destinationTag)
    {
        $this->address = $address;
        $this->destinationTag = $destinationTag;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getDestinationTag(): int
    {
        return $this->destinationTag;
    }

    public static function createFromArray(array $array)
    {
        return new self($array['address'], $array['destination_tag']);
    }
}
