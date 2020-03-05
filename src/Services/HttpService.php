<?php

namespace Quote\Services;

use GuzzleHttp\Client;

class HttpService
{
    /** @var Client $client */
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $url
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $url, array $options = [])
    {
        return $this->request('GET', $url, $options);
    }

    /**
     * @param string $url
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $url, array $options = [])
    {
        return $this->request('POST', $url, $options);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(string $method, string $url, array $options)
    {
        return $this->client->request($method, $url, $options);
    }
}
