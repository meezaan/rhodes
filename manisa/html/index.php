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
      //$c = new Page('rFxeUauT0DI-qhzmPvd2QOu075dcoEwSxIGoJyoQ2Fo', 'kcgcl5c4dlw8', 'master');
      //$c = new Page($_ENV['ACCESS_TOKEN'], $_ENV['SPACE_ID'], $_ENV['ENVIRONMENT']);
      $c = new Page($_ENV['ACCESS_TOKEN'], $_ENV['SPACE_ID'], $_ENV['ENVIRONMENT']);
      $page = $c->getBySlug();

      $response->getBody()->write(json_encode($page));

      return $response->withHeader('Content-Type', 'application/json');
    
    



  });

$app->get('/{slug}', function (Request $request, Response $response, $args) {
//    $slug = $request->getAttribute('slug');
//    $c = new Page('rFxeUauT0DI-qhzmPvd2QOu075dcoEwSxIGoJyoQ2Fo', 'kcgcl5c4dlw8', 'master');
//    $page = $c->getBySlug($slug);
//    $response->getBody()->write(json_encode($page));
/* 
    $cli = new Contentful\Delivery\Client('rFxeUauT0DI-qhzmPvd2QOu075dcoEwSxIGoJyoQ2Fo', 'kcgcl5c4dlw8', 'master');
    $query= new \Contentful\Delivery\Query();
    $query->setInclude(3);

    $e = $cli->getEntries($query);

    //$ae = $cli->getEntries();


    $response->getBody()->write(json_encode($e));

    return $response->withHeader('Content-Type', 'application/json'); */
    
    
    $slug = $request->getAttribute('slug');
    $c = new Page($_ENV['ACCESS_TOKEN'], $_ENV['SPACE_ID'], $_ENV['ENVIRONMENT'],$slug);
    $page = $c->getBySlug();
    $response->getBody()->write(json_encode($page));
    return $response->withHeader('Content-Type', 'application/json');



});



$app->run();
