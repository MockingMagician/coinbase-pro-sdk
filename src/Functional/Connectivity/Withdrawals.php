<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\WithdrawalsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\WithdrawalsDataInterface;

class Withdrawals extends AbstractRequestManagerAware implements WithdrawalsInterface
{
    public function listWithdrawalsRaw(?string $profileId = null, PaginationInterface $pagination = null)
    {
        $query = [
            'profile_id' => $profileId,
        ];

        return $this->getRequestManager()->prepareRequest('GET', '/transfers', $query, null, $pagination)->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function listWithdrawals(?string $profileId = null, PaginationInterface $pagination = null): array
    {
        // TODO: Implement listWithdrawals() method.
    }

    public function getWithdrawalRaw(string $transferId)
    {
        // TODO: Implement getWithdrawal() method.
    }

    /**
     * @inheritDoc
     */
    public function getWithdrawal(string $transferId): WithdrawalsDataInterface
    {
        // TODO: Implement getWithdrawal() method.
    }

    public function withdrawRaw(float $amount, string $currency, string $paymentMethodId): string
    {
        // TODO: Implement withdraw() method.
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
