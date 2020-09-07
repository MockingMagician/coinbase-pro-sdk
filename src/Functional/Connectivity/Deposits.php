<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\DepositsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\CryptoDepositAddressDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\DepositDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\DepositData;
use MockingMagician\CoinbaseProSdk\Functional\Error\ApiError;

class Deposits extends AbstractConnectivity implements DepositsInterface
{
    public function listDepositsRaw(
        ?string $profileId = null,
        ?DateTimeInterface $before = null,
        ?DateTimeInterface $after = null,
        ?int $limit = 100
    ) {
        if ($limit !== null && ($limit < 1 || $limit > 100)) {
            throw new ApiError(sprintf('Limit must between %s ans %s', 1, 100));
        }

        $query = ['type' => 'deposit'];

        if ($profileId) {
            $query['profile_id'] = $profileId;
        }
        if ($before) {
            $query['after'] = $before->format('c'); // api take before for after and "vice et versa"
        }
        if ($after) {
            $query['before'] = $after->format('c'); // api take before for after and "vice et versa"
        }
        if ($limit) {
            $query['limit'] = $limit;
        }
        $query = http_build_query($query);

        return $this->getRequestManager()->prepareRequest('GET', '/transfers?'.$query)->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function listDeposits(
        ?string $profileId = null,
        ?DateTimeInterface $before = null,
        ?DateTimeInterface $after = null,
        ?int $limit = 100
    ): array {
        return DepositData::createCollectionFromJson($this->listDepositsRaw());
    }

    /**
     * @inheritDoc
     */
    public function getDeposit(string $transferId): DepositDataInterface
    {
        // TODO: Implement getDeposit() method.
    }

    /**
     * @inheritDoc
     */
    public function doDeposit(float $amount, string $currency, string $paymentMethodId): string
    {
        // TODO: Implement doDeposit() method.
    }

    /**
     * @inheritDoc
     */
    public function doDepositFromCoinbase(float $amount, string $currency, string $coinbaseAccountId): string
    {
        // TODO: Implement doDepositFromCoinbase() method.
    }

    /**
     * @inheritDoc
     */
    public function generateCryptoDepositAddress(): CryptoDepositAddressDataInterface
    {
        // TODO: Implement generateCryptoDepositAddress() method.
    }
}
