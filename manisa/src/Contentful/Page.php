<?php

namespace Manisa\Contentful;

class Page extends Client
{
    protected string $environment;
    protected string $spaceId;
    protected string $slug;

    public function __construct(string $accessToken, string $spaceId, string $environment = 'master', string $slug = 'home')
    {
        $this->spaceId = $spaceId;
        $this->environment = $environment;
        $this->slug = $slug;
        parent::__construct($accessToken, $spaceId);
    }

    public function getBySlug(int $include = 10): array
    {
        $response = $this->client->get('/spaces/' . $this->spaceId . '/environments/' . $this->environment . '/entries',
        [
            'query' => [
                'access_token' => $this->accessToken,
                'include' => $include,
                'fields.slug' => $this->slug,
                'content_type' => 'page'
              
                
            ]
            
        ]
        );

           

        return json_decode($response->getBody()->getContents(), true);
    }
}
