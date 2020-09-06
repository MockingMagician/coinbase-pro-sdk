<?php


namespace MockingMagician\CoinbaseProSdk\Functional;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use MockingMagician\CoinbaseProSdk\Contracts\ApiParamsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\RequestInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;

class Request implements RequestInterface
{
    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var string
     */
    private $method;
    /**
     * @var string
     */
    private $routePath;
    /**
     * @var string
     */
    private $body;
    /**
     * @var ApiParamsInterface
     */
    private $apiParams;
    /**
     * @var TimeInterface|null
     */
    private $time;

    public function __construct(
        string $method,
        string $routePath,
        ?string $body,
        ClientInterface $client,
        ApiParamsInterface $apiParams,
        ?TimeInterface $time
    ) {
        $this->client = $client;
        $this->method = $method;
        $this->routePath = $routePath;
        $this->body = $body;
        $this->apiParams = $apiParams;
        $this->time = $time;
    }

    public function signAndSend()
    {
        $time = time();
        if ($this->time) {
            $time = $this->time->getTime()->getEpoch();
        }
        $time += 1; //Gives us some 2 extra second for processing before send
        $what = $time . $this->method . $this->routePath . ($this->body ?? '');
        $key = base64_decode($this->apiParams->getSecret());
        $hmac = hash_hmac('sha256', $what, $key, true);
        $sign = base64_encode($hmac);

        $request = new GuzzleRequest(
            $this->method,
            $this->apiParams->getEndPoint().$this->routePath,
            [
                'CB-ACCESS-KEY' => $this->apiParams->getKey(),
                'CB-ACCESS-SIGN' => $sign,
                'CB-ACCESS-TIMESTAMP' => $time,
                'CB-ACCESS-PASSPHRASE' => $this->apiParams->getPassphrase(),
            ],
            $this->body
        );

        return $this->send($request);
    }

    public function send(?PsrRequestInterface $request = null)
    {

        if (!$request) {
            $request = new GuzzleRequest(
                $this->method,
                $this->apiParams->getEndPoint().$this->routePath,
                [],
                $this->body
            );
        }

        return $this->client->send($request)->getBody()->getContents();
    }
}
