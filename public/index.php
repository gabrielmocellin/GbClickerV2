<?php


require_once __DIR__ . '/../vendor/autoload.php';

use GbClicker\Controller\Error404Controller;

use GbClicker\Core\Container;
use GbClicker\Http\Request;
use GbClicker\Http\Session;

$routes = require_once __DIR__ . '/../config/routes.php';

$container = new Container();
$request = new Request();
$session = new Session();

$container->set(Request::class, $request);
$container->set(Session::class, $session);

$path = $request->getPath();
$serverMethod = $request->getMethod();
$key = "$serverMethod|$path";

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes[$key];
    $controller = $container->get($controllerClass);
    $controller->index();
} else {
    $errorController = $container->get(Error404Controller::class);
    $errorController->index();
}

exit();
