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

        if(count($_GET)<2) {
          echo("Missing query string params termsUrl, termsText");
          exit();
       }
       else{
          return $renderer->render($response, "footer/v1/footer.phtml", $_GET);
       }
    });

    $group->get('/v1/navbar', function (Request $request, Response $response, $args) {
        $renderer = new PhpRenderer('../components/');
        return $renderer->render($response, "navbar/v1/navbar.phtml", $_GET);
    });
    
    $group->get('/v1/carousel', function (Request $request, Response $response, $args) {
      $renderer = new PhpRenderer('../components/');
      return $renderer->render($response, "carousel/v1/carousel.phtml");
  });
});

$app->get('/', function (Request $request, Response $response, $args) {
  //$response->getBody()->write("Hello world!");
  $renderer = new PhpRenderer('./');
  

  if(count($_GET)>0) {
    $variables = $request->getQueryParams();
 }
 else{
    $variables = array(
    'termsUrl'  => 'https://www.emirates.com',
    'termsText' => 'terms',
    'options'   => 'home,login');
  }
  return $renderer->render($response,"template.php", $variables);

  });

  $app->get('/login', function (Request $request, Response $response, $args){
      $renderer = new PhpRenderer('./');
      $variables = array(
        'termsUrl'  => 'https://www.emirates.com',
        'termsText' => 'terms',
        'options' => 'home'
    );
      return $renderer->render($response,"login.php", $variables);
  });

$app->run();
