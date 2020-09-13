<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\WithdrawalsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\WithdrawalsDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\WithdrawalsData;

class Withdrawals extends AbstractRequestManagerAware implements WithdrawalsInterface
{
    public function listWithdrawalsRaw(?string $profileId = null, ?PaginationInterface $pagination = null)
    {
        $query = [
            'type' => 'withdraw',
            'profile_id' => $profileId,
        ];

        return $this->getRequestManager()->prepareRequest('GET', '/transfers', $query, null, $pagination)->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function listWithdrawals(?string $profileId = null, ?PaginationInterface $pagination = null): array
    {
        return WithdrawalsData::createCollectionFromJson($this->listWithdrawalsRaw($profileId, $pagination));
    }

    public function getWithdrawalRaw(string $transferId)
    {
        $query = [
            'type' => 'withdraw',
        ];

        return $this->getRequestManager()->prepareRequest('GET', sprintf('/transfers/%s', $transferId), $query)->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function getWithdrawal(string $transferId): WithdrawalsDataInterface
    {
        return WithdrawalsData::createFromJson($this->getWithdrawalRaw($transferId));
    }

    public function withdrawRaw(float $amount, string $currency, string $paymentMethodId): string
    {
        $body = [
            'amount' => $amount,
            'currency' => $currency,
            'payment_method_id' => $paymentMethodId,
        ];

        return $this->getRequestManager()->prepareRequest('POST', '/withdrawals/payment-method', [], json_encode($body))->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function withdraw(float $amount, string $currency, string $paymentMethodId): string
    {
        // TODO: Implement withdraw() method.
    }

    public function withdrawToCoinbaseRaw(float $amount, string $currency, string $coinbaseAccountId)
    {
        // TODO: Implement withdrawToCoinbase() method.
    }

    /**
     * @inheritDoc
     */
    public function withdrawToCoinbase(float $amount, string $currency, string $coinbaseAccountId): string
    {
        // TODO: Implement withdrawToCoinbase() method.
    }

    public function withdrawToCryptoAddressRaw(float $amount, string $currency, string $cryptoAddress, string $destinationTag = null)
    {
        // TODO: Implement withdrawToCryptoAddress() method.
    }

    /**
     * @inheritDoc
     */
    public function withdrawToCryptoAddress(float $amount, string $currency, string $cryptoAddress, string $destinationTag = null): string
    {
        // TODO: Implement withdrawToCryptoAddress() method.
    }
}
