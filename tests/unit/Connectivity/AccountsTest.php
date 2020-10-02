<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\Connectivity;

use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestFactoryInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Request\RequestInterface;
use MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts;
use MockingMagician\CoinbaseProSdk\Functional\DTO\AccountData;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @covers \MockingMagician\CoinbaseProSdk\Functional\Connectivity\Accounts
 */
class AccountsTest extends TestCase
{
    /**
     * @var ObjectProphecy|RequestFactoryInterface
     */
    private $requestFactory;
    /**
     * @var ObjectProphecy|RequestInterface
     */
    private $request;

    public function setUp()
    {
        $this->request = $this->prophesize(RequestInterface::class);
        $this->requestFactory = $this->prophesize(RequestFactoryInterface::class);
    }

    public function testList()
    {
        $this->request->send()->willReturn('[{"id":"18ba201e-6241-4efb-9b89-ed2885954566","currency":"BAT","balance":"1455.0000000000000000","hold":"0.0000000000000000","available":"1455","profile_id":"d9313ff2-2ef2-4f4d-a310-65b5143fde3f","trading_enabled":true},{"id":"2ac4ec8e-1349-4fc4-95dd-236a5ab4deb9","currency":"BTC","balance":"544.1565877400000000","hold":"0.0000000000000000","available":"544.15658774","profile_id":"d9313ff2-2ef2-4f4d-a310-65b5143fde3f","trading_enabled":true}]');
        $this->requestFactory->createRequest('GET', '/accounts')->willReturn($this->request->reveal());
        $account = new Accounts($this->requestFactory->reveal());
        self::assertIsArray($account->list());
    }

    public function testGetAccount()
    {
        $id = '18ba201e-6241-4efb-9b89-ed2885954566';
        $this->request->send()->willReturn('{"id":"18ba201e-6241-4efb-9b89-ed2885954566","currency":"BAT","balance":"1455.0000000000000000","hold":"0.0000000000000000","available":"1455","profile_id":"d9313ff2-2ef2-4f4d-a310-65b5143fde3f","trading_enabled":true}');
        $this->requestFactory->createRequest('GET', sprintf('/accounts/%s', $id))->willReturn($this->request->reveal());
        $account = new Accounts($this->requestFactory->reveal());
        self::assertInstanceOf(AccountData::class, $account->getAccount($id));
    }

    public function testGetHolds()
    {
        $id = '18ba201e-6241-4efb-9b89-ed2885954566';
        $this->request->send()->willReturn('[{"id":"18ba201e-6241-4efb-9b89-ed2885954566","currency":"BAT","balance":"1455.0000000000000000","hold":"0.0000000000000000","available":"1455","profile_id":"d9313ff2-2ef2-4f4d-a310-65b5143fde3f","trading_enabled":true}]');
        $this->requestFactory->createRequest('GET', sprintf('/accounts/%s/holds', $id), [], null, null)->willReturn($this->request->reveal());
        $account = new Accounts($this->requestFactory->reveal());
        self::assertInstanceOf(AccountData::class, $account->getHolds($id));
    }

    public function testGetAccountHistory()
    {
//        $accounts = $this->createPartialMock(Accounts::class, ['getRequestFactory']);
//        $accounts->expects($this->once())->method('getRequestFactory')->willReturn($this->requestFactory->reveal());
//        $accounts->getHolds('some');
    }
}
