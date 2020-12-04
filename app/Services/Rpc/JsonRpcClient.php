<?php


namespace App\Services\Rpc;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class JsonRpcClient
{
    const JSON_RPC_VERSION = '2.0';

    protected $url = '';

    protected $client;

    /**
     * JsonRpcClient constructor.
     * @param string $url
     */
    public function __construct(string $url='')
    {
        $this->client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        $this->url = $url;
    }
    /**
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param string $method
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(string $method, array $params): array
    {
        $response = $this->client
            ->post($this->url, [
                RequestOptions::JSON => [
                    'jsonrpc' => self::JSON_RPC_VERSION,
                    'id' => time(),
                    'method' => $method,
                    'params' => $params
                ]
            ])->getBody()->getContents();

        return json_decode($response, true);
    }
}
