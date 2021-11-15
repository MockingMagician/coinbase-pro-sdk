<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TransfersInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\TransferDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\PaymentMethodData;
use MockingMagician\CoinbaseProSdk\Functional\DTO\TransferData;
use MockingMagician\CoinbaseProSdk\Functional\Enum\TransferTypeEnum;
use MockingMagician\CoinbaseProSdk\Functional\Misc\Json;

class Transfers extends AbstractConnectivity implements TransfersInterface
{
    public function depositFromCoinbaseRaw(float $amount, string $currency, string $coinbaseAccountId): string
    {
        $body = [
            'amount' => $amount,
            'currency' => $currency,
            'coinbase_account_id' => $coinbaseAccountId,
        ];

        return $this->getRequestFactory()->createRequest('POST', '/deposits/coinbase-account', [], Json::encode($body))->send();
    }

    /**
     * {@inheritDoc}
     */
    public function depositFromCoinbase(float $amount, string $currency, string $coinbaseAccountId): string
    {
        return Json::decode($this->depositFromCoinbaseRaw($amount, $currency, $coinbaseAccountId), true)['id'];
    }

    public function depositFromPaymentMethodRaw(float $amount, string $currency, string $paymentMethodId): string
    {
        $body = [
            'amount' => $amount,
            'currency' => $currency,
            'payment_method_id' => $paymentMethodId,
        ];

        return $this->getRequestFactory()->createRequest('POST', '/deposits/payment-method', [], Json::encode($body))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function depositFromPaymentMethod(float $amount, string $currency, string $paymentMethodId): string
    {
        return Json::decode($this->depositFromPaymentMethodRaw($amount, $currency, $paymentMethodId), true)['id'];
    }

    public function listPaymentMethodsRaw(): string
    {
        return $this->getRequestFactory()->createRequest('GET', '/payment-methods')->send();
    }

    /**
     * {@inheritdoc}
     */
    public function listPaymentMethods(): array
    {
        return PaymentMethodData::createCollectionFromJson($this->listPaymentMethodsRaw());
    }

    public function listTransfersRaw(?TransferTypeEnum $type = null, ?PaginationInterface $pagination = null): string
    {
        $query = [];

        if ($type) {
            $query['type'] = $type->value;
        }

        return $this->getRequestFactory()->createRequest(
            'GET',
            '/transfers',
            $query,
            null,
            $pagination
        )->send();
    }

    /**
     * {@inheritdoc}
     */
    public function listTransfers(?TransferTypeEnum $type = null, ?PaginationInterface $pagination = null): array
    {
        return TransferData::createCollectionFromJson($this->listTransfersRaw($type, $pagination));
    }

    public function getTransferRaw(string $transferId): string
    {
        return $this->getRequestFactory()->createRequest('GET', sprintf('/transfers/%s', $transferId))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getTransfer(string $transferId): TransferDataInterface
    {
        return TransferData::createFromJson($this->getTransferRaw($transferId));
    }

    public function withdrawToCoinbaseRaw(float $amount, string $currency, string $coinbaseAccountId): string
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
    public function withdrawToCoinbase(float $amount, string $currency, string $coinbaseAccountId): string
    {
        return Json::decode($this->withdrawToCoinbaseRaw($amount, $currency, $coinbaseAccountId), true)['id'];
    }

    public function withdrawToCryptoAddressRaw(
        float $amount,
        string $currency,
        string $cryptoAddress,
        ?string $destinationTag = null,
        ?float $fee = null,
        ?int $nonce = null,
        ?string $twoFactorCode = null
    ): string {
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

        if ($fee) {
            $body['fee'] = $fee;
        }

        if ($nonce) {
            $body['nonce'] = $nonce;
        }

        if ($twoFactorCode) {
            $body['two_factor_code'] = $twoFactorCode;
        }

        return $this->getRequestFactory()->createRequest('POST', '/withdrawals/crypto', [], Json::encode($body))->send();
    }

    /**
     * {@inheritdoc}
     */
    public function withdrawToCryptoAddress(
        float $amount,
        string $currency,
        string $cryptoAddress,
        ?string $destinationTag = null,
        ?float $fee = null,
        ?int $nonce = null,
        ?string $twoFactorCode = null
    ): string {
        return Json::decode($this->withdrawToCryptoAddressRaw($amount, $currency, $cryptoAddress, $destinationTag), true)['id'];
    }

    public function getFeeEstimateRaw(string $currency, string $cryptoAddress): string
    {
        $query = [
            'currency' => $currency,
            'crypto_address' => $cryptoAddress,
        ];

        return $this->getRequestFactory()->createRequest('GET', '/withdrawals/fee-estimate', $query)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getFeeEstimate(string $currency, string $cryptoAddress): float
    {
        return Json::decode($this->getFeeEstimateRaw($currency, $cryptoAddress), true)['fee'];
    }

    public function withdrawToPaymentMethodRaw(float $amount, string $currency, string $paymentMethodId): string
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
    public function withdrawToPaymentMethod(float $amount, string $currency, string $paymentMethodId): string
    {
        return Json::decode($this->withdrawToPaymentMethodRaw($amount, $currency, $paymentMethodId), true)['id'];
    }
}
