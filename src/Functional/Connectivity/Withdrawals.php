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

    public function doWithdrawRaw(float $amount, string $currency, string $paymentMethodId): string
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
    public function doWithdraw(float $amount, string $currency, string $paymentMethodId): string
    {
        return json_decode($this->doWithdrawRaw($amount, $currency, $paymentMethodId), true)['id'];
    }

    public function doWithdrawToCoinbaseRaw(float $amount, string $currency, string $coinbaseAccountId): string
    {
        $body = [
            'amount' => $amount,
            'currency' => $currency,
            'coinbase_account_id' => $coinbaseAccountId,
        ];

        return $this->getRequestManager()->prepareRequest('POST', '/withdrawals/coinbase-account', [], json_encode($body))->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function doWithdrawToCoinbase(float $amount, string $currency, string $coinbaseAccountId): string
    {
        return json_decode($this->doWithdrawToCoinbaseRaw($amount, $currency, $coinbaseAccountId), true)['id'];
    }

    public function doWithdrawToCryptoAddressRaw(float $amount, string $currency, string $cryptoAddress, string $destinationTag = null)
    {
        $body = [
            'amount' => $amount,
            'currency' => $currency,
            'crypto_address' => $cryptoAddress,
        ];

        if ($destinationTag) {
            $body['destination_tag'] = $destinationTag;
        } else {
            $body['no_destination_tag'] = true;
        }

        return $this->getRequestManager()->prepareRequest('POST', '/withdrawals/crypto', [], json_encode($body))->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function doWithdrawToCryptoAddress(float $amount, string $currency, string $cryptoAddress, string $destinationTag = null): string
    {
        return json_decode($this->doWithdrawToCryptoAddressRaw($amount, $currency, $cryptoAddress, $destinationTag), true)['id'];
    }
}