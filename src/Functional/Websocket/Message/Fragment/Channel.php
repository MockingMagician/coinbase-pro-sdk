<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\Fragment;


class Channel
{
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
}
