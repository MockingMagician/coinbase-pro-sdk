<?php


namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Interface OrderBookDataInterface
 * @package MockingMagician\CoinbaseProSdk\Contracts\DTO
 * {
 * "sequence": "3",
 * "bids": [
 * [ price, size, num-orders ],
 * ],
 * "asks": [
 * [ price, size, num-orders ],
 * ]
 * }
 * Example Response for /products/BTC-USD/book?level=2
 *
 * {
 * "sequence": "3",
 * "bids": [
 * [ price, size, num-orders ],
 * [ "295.96", "4.39088265", 2 ],
 * ...
 * ],
 * "asks": [
 * [ price, size, num-orders ],
 * [ "295.97", "25.23542881", 12 ],
 * ...
 * ]
 * }
 * Example Response for /products/BTC-USD/book?level=3
 *
 * {
 * "sequence": "3",
 * "bids": [
 * [ price, size, order_id ],
 * [ "295.96","0.05088265","3b0f1225-7f84-490b-a29f-0faef9de823a" ],
 * ...
 * ],
 * "asks": [
 * [ price, size, order_id ],
 * [ "295.97","5.72036512","da863862-25f4-4868-ac41-005d11ab0a5f" ],
 * ...
 * ]
 * }
 */
interface OrderBookDataInterface
{
    public function getSequence(): int;
    /**
     * @return OrderBookDetailsDataInterface[]
     */
    public function getBids(): array;
    /**
     * @return OrderBookDetailsDataInterface[]
     */
    public function getAsks(): array;
}
