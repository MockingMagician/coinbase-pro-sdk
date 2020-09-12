<?php


namespace MockingMagician\CoinbaseProSdk\Functional\DTO;


use MockingMagician\CoinbaseProSdk\Contracts\DTO\StableCoinConversionsDataInterface;

class StableCoinConversionsData extends AbstractCreator implements StableCoinConversionsDataInterface
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
     * @var string
     */
    private $fromCurrencyId;
    /**
     * @var string
     */
    private $toCurrencyId;

    public function __construct(
        string $id,
        float $amount,
        string $fromAccountId,
        string $toAccountId,
        string $fromCurrencyId,
        string $toCurrencyId
    ) {
        $this->id = $id;
        $this->amount = $amount;
        $this->fromAccountId = $fromAccountId;
        $this->toAccountId = $toAccountId;
        $this->fromCurrencyId = $fromCurrencyId;
        $this->toCurrencyId = $toCurrencyId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getFromAccountId(): string
    {
        return $this->fromAccountId;
    }

    /**
     * @return string
     */
    public function getToAccountId(): string
    {
        return $this->toAccountId;
    }

    /**
     * @return string
     */
    public function getFromCurrencyId(): string
    {
        return $this->fromCurrencyId;
    }

    /**
     * @return string
     */
    public function getToCurrencyId(): string
    {
        return $this->toCurrencyId;
    }

    public static function createFromArray(array $array, ...$divers)
    {
        return new self(
            $array['id'],
            $array['amount'],
            $array['from_account_id'],
            $array['to_account_id'],
            $array['from'],
            $array['to']
        );
    }
}
