<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->group('/components',  function (RouteCollectorProxy $group)  {
   $group->get('/v1/footer', function (Request $request, Response $response, $args) {
        $renderer = new PhpRenderer('../components/');
        $variables = $request->getQueryParams();
        return $renderer->render($response, "footer/v1/footer.phtml", $variables);
    });

    $group->get('/v1/navbar', function (Request $request, Response $response, $args) {
        $renderer = new PhpRenderer('../components/');
        $variables = $request->getQueryParams();
        return $renderer->render($response, "navbar/v1/navbar.phtml", $variables);
    });

});

$app->get('/', function (Request $request, Response $response, $args) {
  //$response->getBody()->write("Hello world!");
  $renderer = new PhpRenderer('./');
  //$variables = $request->getQueryParams();
  //var_dump($variables);
  $variables = array(
    'termsUrl'  => 'https://www.emirates.com',
    'termsText' => 'terms'
    
);
 // var_dump($variables);
  return $renderer->render($response,"template.php", $variables);

  });

  $app->get('/login', function (Request $request, Response $response, $args){
      $renderer = new PhpRenderer('./');
      return $renderer->render($response,"login.php");
  });

$app->run();
