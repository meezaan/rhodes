<?php

namespace Manisa\Contentful;

class Entries extends Client
{
    protected string $environment;
    protected string $spaceId;

    public function __construct(string $accessToken, string $spaceId, string $environment = 'master')
    {
        $this->spaceId = $spaceId;
        $this->environment = $environment;
        parent::__construct($accessToken, $spaceId);
    }

    public function getOneById(string $id): Entry
    {

        return $this->client->getEntry($id);
    }

    public function getAll(int $include = 10): \stdClass
    {
        $response = $this->client->get('/spaces/' . $this->spaceId . '/environments/' . $this->environment . '/entries',
        [
            'query' => [
                'access_token' => $this->accessToken,
                'include' => $include
            ]
        ]
        );



        return json_decode($response->getBody()->getContents());
    }
}