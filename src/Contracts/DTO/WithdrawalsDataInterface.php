<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

use DateTimeInterface;

/**
 * Interface WithdrawalsDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 *
 * [
 *    {
 *        "id": "6b09bf5e-c94c-405b-b7dc-ad2b27749ce5",
 *        "type": "withdraw",
 *        "created_at": "2019-06-18 02:11:25.610908+00",
 *        "completed_at": "2019-06-18 02:11:26.416758+00",
 *        "canceled_at": null,
 *        "processed_at": "2019-06-18 02:11:37.996052+00",
 *        "account_id": "bcf1fc34-3180-4acf-97be-c1c20a719e34",
 *        "user_id": "5eeace07a181d1e866db83e5",
 *        "user_nonce": "1592624441614",
 *        "amount": "22.00000000",
 *        "details": {
 *            "destination_tag": "567148403",
 *            "sent_to_address": "rw2ciyaNshpHe7bCHo4bRWq6pqqynnWKQg",
 *            "coinbase_account_id": "26dbbe94-7321-4ca4-8744-622f5a98a45a",
 *            "destination_tag_name": "XRP Tag",
 *            "coinbase_withdrawal_id": "935107c5-b443-4cf4-b9ef-e49f856c4de8",
 *            "coinbase_transaction_id": "5eeace0cfe2410af68891bcb",
 *            "crypto_transaction_hash": "217AF4782DFB632121F1EAEF33DBAEC0539A77E5CBFCBA4AA71925ADB2B15D13",
 *            "coinbase_payment_method_id": ""
 *        }
 *    },
 *    ...
 * ]
 */
interface WithdrawalsDataInterface extends DepositDataInterface
{
}
