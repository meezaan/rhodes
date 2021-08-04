<?php


namespace Manisa\Contentful;

use GuzzleHttp\Client as GuzzleHttpClient;

class Client
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string
     */
    private $baseUrl = 'https://cdn.contentful.com';

    protected $accessToken;

    protected $options = [];

    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->client = new GuzzleHttpClient(
            [
                'headers' =>
                    [
                        'User-Agent' => 'AAT8/Architecture'
                    ],
                'base_uri' => $this->baseUrl
            ]
        );

    }

}