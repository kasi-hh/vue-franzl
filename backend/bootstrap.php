<?php
/**
 * Created by PhpStorm.
 * User: kasi
 * Date: 28.01.2019
 * Time: 14:07
 */

use App\Manager;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;

$_SERVER['REQUEST_URI'] = $_SERVER['REQUEST_URI'] ?? $_REQUEST['_url'];

$autoload = require '../vendor/autoload.php';
$autoload->setPsr4('App\\', __DIR__.DIRECTORY_SEPARATOR.'src');

$di = new \Slim\Container(include(__DIR__.'/config.php'));
Manager::setDi($di);

$app = new \Slim\App($di);
$app->get('/api/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    /** @var \App\Repository\Images $repo  */
    $repo = Manager::getClassInstance('repository.images');
    $repo->setDi($this);
    $images = $repo->getImageList();
    return $response->withJson($images);
});
$app->map(['GET','POST'],'/api/{controller}/{action}', function(Request $request, Response $response, array $args){
   $controller = $args['controller'];
   $action = $args['action'].'Action';
   $handler = Manager::getClassInstance('controller.'.$controller);
   if (!is_object($handler)){
       throw new \InvalidArgumentException("Controller [$controller] not found");
   }
   if (method_exists($handler,'setDi')){
       $handler->setDi($this);
   }
   if (method_exists($handler, $action)){
       return $handler->$action($request, $response, $args);
   }
   throw new \InvalidArgumentException("Action [$action] not found in controller $controller");
});
//$app->add(new \App\Auth());
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "secret" => $app->getContainer()->get('settings')['jwt']['secret'],
    "ignore"=>['/api/auth']
]));
try {
    $app->run();
}
catch(\Exception $e){
    echo json_encode([
        'success'=>false,
        'message'=>$e->getMessage(),
        'file'=>$e->getFile(),
        'line'=>$e->getLine()
    ]);
}
