<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Tests\Func\Websocket;

use Dotenv\Dotenv;
use MockingMagician\CoinbaseProSdk\CoinbaseFacade;
use MockingMagician\CoinbaseProSdk\Contracts\Websocket\WebsocketRunnerInterface;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ActivateMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ChangeMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\DoneMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ErrorMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\HeartbeatMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\L2UpdateMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\LastMatchMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\MatchMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\OpenMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ReceivedMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\SnapshotMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\StatusMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\SubscriptionsMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\TickerMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\UnknownMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Subscriber;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\SubscriberAuthenticateAware;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Websocket;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\WebsocketRunner;
use MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity\AbstractTest;

/**
 * @internal
 */
final class WebsocketTest extends AbstractTest
{
    /**
     * @var Websocket
     */
    private $websocket;
    /**
     * @var \MockingMagician\CoinbaseProSdk\Functional\Api\CoinbaseApi
     */
    private $coinbaseApi;

    public function setUp(): void
    {
        try {
            $dotenv = Dotenv::createImmutable(__DIR__.'/../../..');
            $dotenv->load();
        } catch (\Throwable $exception) {
            // We don't care, it is just a way between a lot to load envs
        }

        $params = [
            getenv('API_KEY_REAL_FOR_WEBSOCKET'),
            getenv('API_SECRET_REAL_FOR_WEBSOCKET'),
            getenv('API_PASSPHRASE_REAL_FOR_WEBSOCKET'),
        ];

        if (in_array(false, $params)) {
            $this->markTestSkipped('Functional tests for websocket require REAL(production) key, secret, passphrase.');
        }

        $this->coinbaseApi = CoinbaseFacade::createDefaultCoinbaseApi(
            'https://api.pro.coinbase.com',
            ...$params
        );
        if (!$this->retryHasInternetConnection(3, 1)) {
            $this->markTestSkipped('Functional tests require an internet connection.');
        }
        ini_set('xdebug.var_display_max_depth', '16');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '4096');
        $this->websocket = new Websocket(new WebsocketRunner());
    }

    public function testSubscription()
    {
        $this->websocket->run($this->getSimpleSubscriber(), function ($runner) {
            /** @var WebsocketRunnerInterface $runner */
            $error = null;
            $subscriptionMessageFound = false;
            $im = $i = 500;
            while ($i--) {
                $message = $runner->getMessage();
                if ($message instanceof SubscriptionsMessage) {
                    $subscriptionMessageFound = true;
                }
                if ($message instanceof ErrorMessage) {
                    $error = $message->getMessage().'. '.$message->getReason();

                    break;
                }
            }
            self::assertNull($error, $error ?? '');
            self::assertTrue($subscriptionMessageFound, sprintf('No subscription message found in %s first messages received', $im));
        });
    }

    public function testSubscriptionAuthenticate()
    {
        $this->websocket->run($this->getAuthenticateSubscriber(), function ($runner) {
            /** @var WebsocketRunnerInterface $runner */
            $error = null;
            $subscriptionMessageFound = false;
            $im = $i = 500;
            while ($i--) {
                $message = $runner->getMessage();
                if ($message instanceof SubscriptionsMessage) {
                    $subscriptionMessageFound = true;
                }
                if ($message instanceof ErrorMessage) {
                    $error = $message->getMessage().'. '.$message->getReason();

                    break;
                }
            }
            self::assertNull($error, $error ?? '');
            self::assertTrue($subscriptionMessageFound, sprintf('No subscription message found in %s first messages received', $im));
        });
    }

    public function testMessagesLongRun()
    {
        $method = __METHOD__;
        $subscriber = $this->getSimpleSubscriber();
        $subscriber->activateChannelLevel2(false);
        $subscriber->activateChannelStatus(false);
        $subscriber->activateChannelTicker(false);
        $subscriber->activateChannelMatches(false);
        $subscriber->activateChannelHeartbeat(false);
        $this->websocket->run($subscriber, function ($runner, $method) {
            /** @var WebsocketRunnerInterface $runner */
            $messagesTypeCounter = [
                ActivateMessage::class => 0,
                ChangeMessage::class => 0,
                DoneMessage::class => 0,
                ErrorMessage::class => 0,
                HeartbeatMessage::class => 0,
                L2UpdateMessage::class => 0,
                LastMatchMessage::class => 0,
                MatchMessage::class => 0,
                OpenMessage::class => 0,
                ReceivedMessage::class => 0,
                SnapshotMessage::class => 0,
                StatusMessage::class => 0,
                SubscriptionsMessage::class => 0,
                TickerMessage::class => 0,
                UnknownMessage::class => 0,
            ];
            $im = $i = 10 ** 5;
            fwrite(STDOUT, sprintf("\nExecuting %s", $method));
            fwrite(STDOUT, "\nHas {$im} messages to fetch, rest :\n\r");
            while ($i--) {
                fwrite(STDOUT, "\r".preg_replace('/./', ' ', $im)."\r{$i}");
                $message = $runner->getMessage();
                ++$messagesTypeCounter[get_class($message)];
            }
            $this->assertEquals(array_sum($messagesTypeCounter), $im);
        }, $method);
    }

    private function getSimpleSubscriber(): Subscriber
    {
        $subscriber = new Subscriber();
        $subscriber->setProductIds($this->getProductIds());
        $subscriber->activateChannelTicker(true);
        $subscriber->activateChannelMatches(true);
        $subscriber->activateChannelStatus(true);
        $subscriber->activateChannelLevel2(true);
        $subscriber->activateChannelHeartbeat(true);
        $subscriber->activateChannelFull(true);

        return $subscriber;
    }

    private function getProductIds(): array
    {
        $products = $this->coinbaseApi->products()->getProducts();
        $productIds = [];
        foreach ($products as $product) {
            $productIds[] = $product->getId();
        }

        return array_values(array_filter($productIds, function ($value) {
            if (
                false === stripos($value, 'USDC')
                && false === stripos($value, 'GBP')
                && false === stripos($value, 'USD')
            ) {
                return true;
            }

            return false;
        }));
    }

    private function getAuthenticateSubscriber(): Subscriber
    {
        $subscriber = new SubscriberAuthenticateAware($this->coinbaseApi);
        $subscriber->setProductIds($this->getProductIds());
        $subscriber->runWithAuthentication(true);
        $subscriber->activateChannelUser(true);
        $subscriber->activateChannelTicker(true);
        $subscriber->activateChannelMatches(true);
        $subscriber->activateChannelStatus(true);
        $subscriber->activateChannelLevel2(true);
        $subscriber->activateChannelHeartbeat(true);

        return $subscriber;
    }
}
