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

});

$app->run();