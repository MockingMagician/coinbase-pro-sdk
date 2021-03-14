<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Websocket\Message;

use DateTimeImmutable;
use MockingMagician\CoinbaseProSdk\Functional\DTO\L2UpdateChange;

class L2UpdateMessage extends AbstractMessage
{
    /**
     * @var string
     */
    private $productId;
    /**
     * @var DateTimeImmutable
     */
    private $time;
    /**
     * @var L2UpdateChange[]
     */
    private $changes;

    public function __construct(array $payload)
    {
        parent::__construct($payload);
        $this->productId = $payload['product_id'];
        $this->time = new DateTimeImmutable($payload['time']);
        $this->changes = [];

        foreach ($payload['changes'] as $change) {
            $this->changes[] = L2UpdateChange::createFromArray($change);
        }
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getTime(): DateTimeImmutable
    {
        return $this->time;
    }

    /**
     * @return L2UpdateChange[]
     */
    public function getChanges(): array
    {
        return $this->changes;
    }
}
