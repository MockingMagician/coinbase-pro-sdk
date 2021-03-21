<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\WithdrawalsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\WithdrawalsDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\WithdrawalsData;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

class Withdrawals extends AbstractConnectivity implements WithdrawalsInterface
{
    public function listWithdrawalsRaw(?string $profileId = null, ?PaginationInterface $pagination = null): string
    {
        $query = [
            'type' => 'withdraw',
            'profile_id' => $profileId,
        ];

        return $this->getRequestFactory()->createRequest('GET', '/transfers', $query, null, $pagination)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function listWithdrawals(?string $profileId = null, ?PaginationInterface $pagination = null): array
    {
        return WithdrawalsData::createCollectionFromJson($this->listWithdrawalsRaw($profileId, $pagination));
    }

    public function getWithdrawalRaw(string $transferId): string
    {
        $query = [
            'type' => 'withdraw',
        ];

        return $this->getRequestFactory()->createRequest('GET', sprintf('/transfers/%s', $transferId), $query)->send();
    }

    /**
     * {@inheritdoc}
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

        return $this->getRequestFactory()->createRequest('POST', '/withdrawals/payment-method', [], Json::encode($body))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function doWithdraw(float $amount, string $currency, string $paymentMethodId): string
    {
        return Json::decode($this->doWithdrawRaw($amount, $currency, $paymentMethodId), true)['id'];
    }

    public function doWithdrawToCoinbaseRaw(float $amount, string $currency, string $coinbaseAccountId): string
    {
        $body = [
            'amount' => $amount,
            'currency' => $currency,
            'coinbase_account_id' => $coinbaseAccountId,
        ];

        return $this->getRequestFactory()->createRequest('POST', '/withdrawals/coinbase-account', [], Json::encode($body))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function doWithdrawToCoinbase(float $amount, string $currency, string $coinbaseAccountId): string
    {
        return Json::decode($this->doWithdrawToCoinbaseRaw($amount, $currency, $coinbaseAccountId), true)['id'];
    }

    public function doWithdrawToCryptoAddressRaw(float $amount, string $currency, string $cryptoAddress, string $destinationTag = null): string
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

        return $this->getRequestFactory()->createRequest('POST', '/withdrawals/crypto', [], Json::encode($body))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function doWithdrawToCryptoAddress(float $amount, string $currency, string $cryptoAddress, string $destinationTag = null): string
    {
        return Json::decode($this->doWithdrawToCryptoAddressRaw($amount, $currency, $cryptoAddress, $destinationTag), true)['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getFeeEstimate(string $currency, string $cryptoAddress): float
    {
        return Json::decode($this->getFeeEstimateRaw($currency, $cryptoAddress), true)['fee'];
    }

    public function getFeeEstimateRaw(string $currency, string $cryptoAddress): string
    {
        $query = [
            'currency' => $currency,
            'crypto_address' => $cryptoAddress,
        ];

        return $this->getRequestFactory()->createRequest('GET', '/withdrawals/fee-estimate', $query)->send();
    }
}
