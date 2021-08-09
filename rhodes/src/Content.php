<?php

namespace Rhodes;

use GuzzleHttp\Client as GuzzleHttpClient;

class Content extends GuzzleHttpClient

{
   
    public function getBySlug(string $slug='home'): \stdClass
    {
       
       // $base_uri = 'http://manisa.x.7x.ax';
        $base_uri = 'http://rhodes_manisa_1:8080';
        $client = new GuzzleHttpClient(
            [
                'headers' =>
                    [
                        'User-Agent' => 'AAT8/Architecture'
                    ],
                'base_uri' => $base_uri
            ]
                );
        //$client = new Client([$base_uri]);
        $response = $client->get('/' . $slug);
       
        return json_decode($response->getBody()->getContents());
    }




}


    





