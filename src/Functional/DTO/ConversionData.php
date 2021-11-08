<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\DTO;

use MockingMagician\CoinbaseProSdk\Contracts\DTO\ConversionDataInterface;

class ConversionData extends AbstractCreator implements ConversionDataInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var float
     */
    private $amount;
    /**
     * @var string
     */
    private $fromAccountId;
    /**
     * @var string
     */
    private $toAccountId;
    /**
     * @var null|string
     */
    private $from;
    /**
     * @var null|string
     */
    private $to;

    public function __construct(
        string $id,
        float $amount,
        string $fromAccountId,
        string $toAccountId,
        ?string $from,
        ?string $to
    ) {
        $this->id = $id;
        $this->amount = $amount;
        $this->fromAccountId = $fromAccountId;
        $this->toAccountId = $toAccountId;
        $this->from = $from;
        $this->to = $to;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getFromAccountId(): string
    {
        return $this->fromAccountId;
    }

    public function getToAccountId(): string
    {
        return $this->toAccountId;
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }

    public function getTo(): ?string
    {
        return $this->to;
    }

    public static function createFromArray(array $array, ...$extraData)
    {
        return new static(
            $array['id'],
            $array['amount'],
            $array['from_account_id'],
            $array['to_account_id'],
            $array['from'] ?? null,
            $array['to'] ?? null
        );
    }
}
