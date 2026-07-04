<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../vendor/autoload.php';

use GbClicker\Controller\Error404Controller;

$routes = require_once __DIR__ . '/../config/routes.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$serverMethod = $_SERVER['REQUEST_METHOD'];
$key = "$serverMethod|$path";

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes[$key];
    $controller = new $controllerClass();
    $controller->index();
} else {
    $errorController = new Error404Controller();
    $errorController->index();
}

exit();
