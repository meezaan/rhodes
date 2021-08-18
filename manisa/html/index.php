<?php

use Manisa\Contentful\guzzlePage;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Manisa\Contentful\Page;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/dotenv-loader.php';

$app = AppFactory::create();

$app->get('/entries', function (Request $request, Response $response, $args) {
    $c = new \Manisa\Contentful\Entries($_ENV['ACCESS_TOKEN'], $_ENV['SPACE_ID'], $_ENV['ENVIRONMENT']);
    $entries = $c->getAll();

    $response->getBody()->write(json_encode($entries));

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/', function (Request $request, Response $response, $args) {
      
      $c = new Page($_ENV['ACCESS_TOKEN'], $_ENV['SPACE_ID'], $_ENV['ENVIRONMENT']);
      $page = $c->getBySlug();

      $response->getBody()->write(json_encode($page));
//
//        $entry = $page['includes']['Entry']; // List of Entry types
//        //$assets = $page->includes->Asset; //List of Asset types
//
//
//        $x = [];
//        $x['items'] = $page['items'];
//        foreach ($entry as $e) {
//            $x['includes'][$e['sys']['id']] = [];
//            $x['includes'][$e['sys']['id']]['original'] = $e;
//            $x['includes'][$e['sys']['id']]['type'] = $e['metadata']['tags'][0]['sys']['id'];
//        }
//
//        $response->getBody()->write(json_encode($x));


      return $response->withHeader('Content-Type', 'application/json');
    
    



  });

$app->get('/{slug}', function (Request $request, Response $response, $args) {

    
    $slug = $request->getAttribute('slug');
    $c = new Page($_ENV['ACCESS_TOKEN'], $_ENV['SPACE_ID'], $_ENV['ENVIRONMENT'],$slug);
    $page = $c->getBySlug();
    $response->getBody()->write(json_encode($page));
    return $response->withHeader('Content-Type', 'application/json');



});



$app->run();
