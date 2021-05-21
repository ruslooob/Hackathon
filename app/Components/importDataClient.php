<?php


class importDataClient
{
    public $client;

    public function __construct()
    {
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://httpbin.org',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);
    }

}
