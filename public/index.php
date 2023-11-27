<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    $routes = require_once __DIR__ . '/../config/routes.php';

    use GbClicker\Controller\{
        LandingpageController,
        ImportController,
        ItemController,
        LoginController,
        RegisterController,
        SaveRegisterController,
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
    } else {
        Error404Controller::index();
    }
    exit();
