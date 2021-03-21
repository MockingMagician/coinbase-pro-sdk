<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Misc;

class Signer
{
    public static function sign(
        string $key,
        string $secret,
        string $passphrase,
        string $method,
        string $route,
        string $body,
        float $time
    ): SignData {
        $what = $time.$method.$route.$body;
        $secret = base64_decode($secret);
        $hmac = hash_hmac('sha256', $what, $secret, true);
        $signature = base64_encode($hmac);

        return new SignData($signature, $key, $passphrase, $time);
    }
}
