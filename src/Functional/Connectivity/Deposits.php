<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\DepositsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\CryptoDepositAddressDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\DepositDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\CryptoDepositAddressData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\DepositData;

class Deposits extends AbstractRequestManagerAware implements DepositsInterface
{
    public function listDepositsRaw(?string $profileId = null, ?PaginationInterface $pagination = null)
    {
        $query = ['type' => 'deposit'];

        if ($profileId) {
            $query['profile_id'] = $profileId;
        }

        return $this->getRequestManager()->prepareRequest('GET', '/transfers', $query, null, $pagination)->signAndSend();
    }

    /**
     * {@inheritdoc}
     */
    public function listDeposits(?string $profileId = null, ?PaginationInterface $pagination = null): array
    {
        return DepositData::createCollectionFromJson($this->listDepositsRaw($profileId, $pagination));
    }

    public function getDepositRaw(string $depositId)
    {
        $query = ['type' => 'deposit'];

        return $this->getRequestManager()->prepareRequest('GET', sprintf('/transfers/%s', $depositId), $query)->signAndSend();
    }

    /**
     * {@inheritdoc}
     */
    public function getDeposit(string $depositId): DepositDataInterface
    {
        return DepositData::createFromJson($this->getDepositRaw($depositId));
    }

    public function doDepositRaw(float $amount, string $currency, string $paymentMethodId): string
    {
        $body = [
            'amount' => $amount,
            'currency' => $currency,
            'payment_method_id' => $paymentMethodId,
        ];

        return $this->getRequestManager()->prepareRequest('POST', '/deposits/payment-method', [], json_encode($body))->signAndSend();
    }

    /**
     * {@inheritdoc}
     */
    public function doDeposit(float $amount, string $currency, string $paymentMethodId): string
    {
        return json_decode($this->doDepositRaw($amount, $currency, $paymentMethodId), true)['id'];
    }

    public function doDepositFromCoinbaseRaw(float $amount, string $currency, string $coinbaseAccountId)
    {
        $body = [
            'amount' => $amount,
            'currency' => $currency,
            'coinbase_account_id' => $coinbaseAccountId,
        ];

        return $this->getRequestManager()->prepareRequest('POST', '/deposits/coinbase-account', [], json_encode($body))->signAndSend();
    }

    /**
     * {@inheritdoc}
     */
    public function doDepositFromCoinbase(float $amount, string $currency, string $coinbaseAccountId): string
    {
        return json_decode($this->doDepositFromCoinbaseRaw($amount, $currency, $coinbaseAccountId), true)['id'];
    }

    public function generateCryptoDepositAddressRaw(string $coinbaseAccountId)
    {
        return $this->getRequestManager()->prepareRequest('POST', sprintf('/coinbase-accounts/%s/addresses', $coinbaseAccountId))->signAndSend();
    }

    /**
     * {@inheritdoc}
     */
    public function generateCryptoDepositAddress(string $coinbaseAccountId): CryptoDepositAddressDataInterface
    {
        return CryptoDepositAddressData::createFromJson($this->generateCryptoDepositAddressRaw($coinbaseAccountId));
    }
}
