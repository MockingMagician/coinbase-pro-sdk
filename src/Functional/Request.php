<?php


namespace MockingMagician\CoinbaseProSdk\Functional;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use MockingMagician\CoinbaseProSdk\Contracts\ApiParamsInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\TimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\RequestInterface;
use MockingMagician\CoinbaseProSdk\Functional\Build\Pagination;
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
    /**
     * @var Pagination|null
     */
    private $pagination;

    public function __construct(
        string $method,
        string $routePath,
        ?string $body,
        ?Pagination $pagination,
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
        $this->pagination = $pagination;
    }

    public function signAndSend()
    {
        $time = time();
        if ($this->time) {
            $time = $this->time->getTime()->getEpoch();
        }
        $time += 1; //Gives us extra second for processing before send
        if ($this->pagination) {
            $this->routePath .= '?' . $this->pagination->getURI();
        }
        $what = $time . $this->method . $this->routePath . ($this->body ?? '');
        $key = base64_decode($this->apiParams->getSecret());
        $hmac = hash_hmac('sha256', $what, $key, true);
        $sign = base64_encode($hmac);

        $uri = $this->apiParams->getEndPoint().$this->routePath;

        $request = new GuzzleRequest(
            $this->method,
            $uri,
            [
                'CB-ACCESS-KEY' => $this->apiParams->getKey(),
                'CB-ACCESS-SIGN' => $sign,
                'CB-ACCESS-TIMESTAMP' => $time,
                'CB-ACCESS-PASSPHRASE' => $this->apiParams->getPassphrase(),
                'Content-Type' => 'application/json',
            ],
            $this->body
        );

        return $this->send($request);
    }

    public function send(?PsrRequestInterface $request = null)
    {
        if (!$request) {
            if ($this->pagination) {
                $this->routePath .= '?' . $this->pagination->getURI();
            }
            $uri = $this->apiParams->getEndPoint().$this->routePath;

            $request = new GuzzleRequest(
                $this->method,
                $uri,
                [
                    'Content-Type' => 'application/json',
                ],
                $this->body
            );
        }

        $response = $this->client->send($request);

//        var_dump($response->getHeader(Pagination::HEADER_AFTER));
//        var_dump($response->getHeader(Pagination::HEADER_BEFORE));

        return $response->getBody()->getContents();
    }
}
