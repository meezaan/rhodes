<?php

namespace Manisa\Contentful;

use Contentful\Core\Resource\ResourceArray;
use Contentful\Delivery\Client;
use Contentful\Delivery\Query;
use Contentful\Delivery\Resource\Entry;

class Page
{
    private Client $client;


    public function __construct(string $accessToken, string $spaceId, string $environment)
    {
        $this->client = new Client($accessToken, $spaceId, $environment);
    }

    public function getBySlug(string $slug): ResourceArray
    {
        $query = new Query();
        $query->setContentType('page')
            ->where('fields.slug', $slug);
        $query->setInclude(3);

        return $this->client->getEntries($query);
    }

}