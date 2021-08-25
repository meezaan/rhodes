<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/../vendor/autoload.php';

function getMasterContent() {
  
  $url = "https://cdn.contentful.com/spaces/kcgcl5c4dlw8/environments/master/entries?access_token=rFxeUauT0DI-qhzmPvd2QOu075dcoEwSxIGoJyoQ2Fo";
           
  $curl = curl_init();

    //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($result, true);
    //print $result->{'total'};
    $fields = $result['includes']['Asset'][0]['fields'];
    $url = $fields['file']['url'];
    $t = $fields['title'];
    $d = $fields['description'];
    $variables = array ();
    $variables += [ "title" => $t, "description" => $d, "url" => $url ];
    return $variables;
}


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
      return $renderer->render($response, "carousel/v1/carousel.phtml", $_GET);
  });

});

$app->get('/', function (Request $request, Response $response, $args) {
  //$response->getBody()->write("Hello world!");
  $renderer = new PhpRenderer('./');

   $c = new Rhodes\Content();      
   $page = $c->getBySlug();
   

    $t = $page->title;

    $header = $page->header;
    $rows = $page->rows;
    $footer = $page->footer;
    $variables = array('header' =>$header,'rows' => $rows,'footer' => $footer);
    //echo "<pre>";
    //print_r($rows);
    //var_dump($variables);exit;
   // var_dump($variables);exit;
    

    /* $url = $page->rows[0]->components[0]->image->url;
    $d = $page->rows[0]->components[0]->image->description;
    $nav_links = $page->header->navbar->links;
    $nav_name = $page->header->navbar->name;
    $variables = array(
      'termsUrl'  => $url,
      'termsText' => $d,
      'navName' => $nav_name,
      'links' =>  $nav_links,
      'title' => 'test',
      'url' => 'www.emirates.com',
      'description' => 'test'

  );
    var_dump($variables); */

    //echo "<pre>";
    //print_r($page);exit;

    return $renderer->render($response,"template.php", $variables);
    //return $renderer->render($response,"home.php", $variables);
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
