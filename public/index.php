<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GbClicker\Controller\Error404Controller;

$routes = require_once __DIR__ . '/../config/routes.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$serverMethod = $_SERVER['REQUEST_METHOD'];
$key = "$serverMethod|$path";

if (array_key_exists($key, $routes)) {
    $prefixChangesNeeded = (substr_count($path, '/') - 1);
    $GLOBALS['prefix'] = '';

    for ($i = 0; $i < $prefixChangesNeeded; $i++) {
        $GLOBALS['prefix'] .= '../';
    }

    $controllerClass = $routes[$key];
    $controllerClass::index();
} else {
    Error404Controller::index();
}

exit();
