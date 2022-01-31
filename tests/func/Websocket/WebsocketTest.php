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
use MockingMagician\CoinbaseProSdk\Functional\Api\CoinbaseApi;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\ErrorMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Message\SubscriptionsMessage;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\Websocket;
use MockingMagician\CoinbaseProSdk\Functional\Websocket\WebsocketRunner;
use MockingMagician\CoinbaseProSdk\Tests\Func\Connectivity\AbstractTest;

/**
 * @internal
 */
final class WebsocketTest extends AbstractTest
{
    /**
     * @var CoinbaseApi
     */
    private $coinbaseApi;
    /**
     * @var Websocket
     */
    private $simpleWebsocket;
    /**
     * @var null|Websocket
     */
    private $authenticatedWebsocket;

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

        $this->coinbaseApi = CoinbaseFacade::createDefaultCoinbaseApi(
            'https://api.pro.coinbase.com',
            ...$params
        );

        if (!in_array(false, $params)) {
            $this->authenticatedWebsocket = new Websocket(new WebsocketRunner(), $this->coinbaseApi);
        }

        if (!$this->retryHasInternetConnection(3, 1)) {
            $this->markTestSkipped('Functional tests require an internet connection.');
        }
        ini_set('xdebug.var_display_max_depth', '16');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '4096');

        $this->simpleWebsocket = new Websocket(new WebsocketRunner());
    }

    public function testSubscribeChannelHeartbeat()
    {
        $subscriber = $this->simpleWebsocket->newSubscriber();
        $subscriber->activateChannelHeartbeat(true, ['BTC-EUR', 'BTC-USD']);
        $this->simpleWebsocket->run($subscriber, function ($runner) {
            /** @var WebsocketRunnerInterface $runner */
            $error = null;
            $subscriptionMessageFound = false;
            $im = $i = 10;
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

    public function testSubscribeChannelMatches()
    {
        $subscriber = $this->simpleWebsocket->newSubscriber();
        $subscriber->activateChannelMatches(true, ['BTC-EUR', 'BTC-USD']);
        $this->simpleWebsocket->run($subscriber, function ($runner) {
            /** @var WebsocketRunnerInterface $runner */
            $error = null;
            $subscriptionMessageFound = false;
            $im = $i = 10;
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

    public function testSubscribeChannelTicker()
    {
        $subscriber = $this->simpleWebsocket->newSubscriber();
        $subscriber->activateChannelTicker(true, ['BTC-EUR', 'BTC-USD']);
        $this->simpleWebsocket->run($subscriber, function ($runner) {
            /** @var WebsocketRunnerInterface $runner */
            $error = null;
            $subscriptionMessageFound = false;
            $im = $i = 10;
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

    public function testSubscribeChannelStatus()
    {
        $subscriber = $this->simpleWebsocket->newSubscriber();
        $subscriber->activateChannelStatus(true);
        $this->simpleWebsocket->run($subscriber, function ($runner) {
            /** @var WebsocketRunnerInterface $runner */
            $error = null;
            $subscriptionMessageFound = false;
            $im = $i = 3;
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

    public function testSubscribeChannelLevel2()
    {
        $subscriber = $this->simpleWebsocket->newSubscriber();
        $subscriber->activateChannelLevel2(true, ['BTC-EUR', 'BTC-USD']);
        $this->simpleWebsocket->run($subscriber, function ($runner) {
            /** @var WebsocketRunnerInterface $runner */
            $error = null;
            $subscriptionMessageFound = false;
            $im = $i = 4;
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

    public function testSubscribeChannelFull()
    {
        $subscriber = $this->simpleWebsocket->newSubscriber();
        $subscriber->activateChannelFull(true, ['BTC-EUR', 'BTC-USD']);
        $this->simpleWebsocket->run($subscriber, function ($runner) {
            /** @var WebsocketRunnerInterface $runner */
            $error = null;
            $subscriptionMessageFound = false;
            $im = $i = 10;
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

    public function testSubscribeChannelUser()
    {
        if (is_null($this->authenticatedWebsocket)) {
            $this->markTestSkipped(sprintf(
                'Functional test `%s` for websocket require REAL(production) key, secret, passphrase.',
                __METHOD__
            ));

            return;
        }
        $subscriber = $this->authenticatedWebsocket->newSubscriber();
        $subscriber->activateChannelUser(true, ['BTC-EUR', 'BTC-USD']);
        $this->authenticatedWebsocket->run($subscriber, function ($runner) {
            /** @var WebsocketRunnerInterface $runner */
            $error = null;
            $subscriptionMessageFound = false;
            $im = $i = 1;
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

    public function testSubscribeAllChannels()
    {
        $subscriber = $this->simpleWebsocket->newSubscriber();
        $subscriber->setProductIds(['BTC-EUR', 'BTC-USD']);
        $subscriber->activateChannelFull(true);
        $subscriber->activateChannelLevel2(true);
        $subscriber->activateChannelStatus(true);
        $subscriber->activateChannelTicker(true);
        $subscriber->activateChannelMatches(true);
        $subscriber->activateChannelHeartbeat(true);
        $this->simpleWebsocket->run($subscriber, function ($runner) {
            /** @var WebsocketRunnerInterface $runner */
            $error = null;
            $subscriptionMessageFound = false;
            $im = $i = 10;
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
        $subscriber = $this->simpleWebsocket->newSubscriber();
        $subscriber->setProductIds(['BTC-EUR', 'BTC-USD']);
        $subscriber->activateChannelLevel2(true);
        $subscriber->activateChannelStatus(true);
        $subscriber->activateChannelTicker(true);
        $subscriber->activateChannelMatches(true);
        $subscriber->activateChannelHeartbeat(true);
        $subscriber->activateChannelFull(true);
        $this->simpleWebsocket->run($subscriber, function ($runner, $method) {
            /** @var WebsocketRunnerInterface $runner */
            $messagesTypeCounter = [];
            $im = $i = 10 ** 5;
            fwrite(STDOUT, sprintf("\nExecuting %s", $method));
            fwrite(STDOUT, "\nHas {$im} messages to fetch, rest :\n\r");
            while ($i--) {
                fwrite(STDOUT, "\r".preg_replace('/./', ' ', $im)."\r{$i}");
                $message = $runner->getMessage();
                @++$messagesTypeCounter[get_class($message)];
            }
            $this->assertEquals(array_sum($messagesTypeCounter), $im);
            $this->assertArrayNotHasKey(ErrorMessage::class, $messagesTypeCounter);
        }, $method);
    }
}
