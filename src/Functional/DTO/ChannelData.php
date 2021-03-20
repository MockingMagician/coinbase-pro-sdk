<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\ChannelDataInterface;

class ChannelData extends AbstractCreator implements ChannelDataInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string[]
     */
    private $productsIds;

    public function __construct(string $name, array $productsIds)
    {
        $this->name = $name;
        $this->productsIds = $productsIds;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string[]
     */
    public function getProductsIds(): array
    {
        return $this->productsIds;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['name'],
            $array['product_ids']
        );
    }
}
