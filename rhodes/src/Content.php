<?php

namespace Rhodes;

use GuzzleHttp\Client as GuzzleHttpClient;

class Content extends GuzzleHttpClient

{
   
    public function getBySlug(string $slug='home'): \stdClass
    {
       
      

        $client = new GuzzleHttpClient(
            [
                'headers' =>
                    [
                        'User-Agent' => 'AAT8/Architecture'
                    ],
                'base_uri' => getenv('MANISA_URI')
            ]
                );
        //$client = new Client([$base_uri]);
        $response = $client->get('/' . $slug);
       
        return json_decode($response->getBody()->getContents());
    }




}


    





