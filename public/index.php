<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    $routes = require_once __DIR__ . '/../config/routes.php';
    $pdo = require_once __DIR__ . '/../config/pdo.php';

    use GbClicker\Controller\{
        LandingpageController,
        ImportController,
        ItemController,
        LoginController,
        RegisterController,
        ShopController,
        Error404Controller
    };
    use GbClicker\Model\{
        ItemModel,
        LevelModel,
        UserModel
    };
    use GbClicker\DAO\{
        Dao,
        IDAO,
        ItemDAO,
        LevelDAO,
        UserDAO
    };

    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $serverMethod = $_SERVER['REQUEST_METHOD'];
    $key = "$serverMethod|$path";

    if (array_key_exists($key, $routes)) {
        $controllerClass = new $routes[$key]();
        $controllerClass::index();
    }

    exit();
    /*
    switch($path){
        case '/':
            LandingpageController::index();
            break;

        case '/login':
            LoginController::index();
            break;

        case '/register':
            RegisterController::index();
            break;

        case '/register/save':
            ImportController::dao();
            ImportController::user();
            RegisterController::register();
            break;

        case '/home':
            ImportController::dao();
            ImportController::user();
            LoginController::login();
            break;

        case '/shop':
            ShopController::shop();
            break;

        case '/items':
            ItemController::index();
            break;

        case '/items/save':
            ImportController::dao();
            ImportController::items();
            ItemController::create();
            break;

        case '/logout':
            LoginController::logout();
            break;

        default:
            echo "<h1>Página não encontrada!</h1>";
            echo "<h3>$url</h3>";
            break;
    }
    */
    