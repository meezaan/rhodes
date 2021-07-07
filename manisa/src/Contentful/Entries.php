<?php

namespace Manisa\Contentful;

use Contentful\Core\Resource\ResourceArray;
use Contentful\Delivery\Client;
use Contentful\Delivery\Resource\Entry;

class Entries
{
    private Client $client;


    public function __construct(string $accessToken, string $spaceId, string $environment)
    {
        $this->client = new Client($accessToken, $spaceId, $environment);
    }

    public function getOneById(string $id): Entry
    {
        return $this->client->getEntry($id);
    }

    public function getAll(): ResourceArray
    {
        return $this->client->getEntries();
    }
}