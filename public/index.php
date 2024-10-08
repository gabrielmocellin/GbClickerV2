<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    $routes = require_once __DIR__ . '/../config/routes.php';

    use GbClicker\Components\Shop\GetItemQuantAPI;

    use GbClicker\Controller\{
        AccountsController,
        LandingpageController,
        LoginController,
        LogoutController,
        RegisterController,
        HomeController,
        ItemController,
        SaveRegisterController,
        ShopController,
        ProfileController,
        AdminPageController,
        SaveAccountEditController,
        SavePurchaseController,
        SaveMoneyController,
        Error404Controller,
        MinionsMoneyController,
        ClickController
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

        $prefixChangesNeeded = (substr_count($path, '/') - 1);
        $GLOBALS['prefix'] = "";
        
        for ($i = 0; $i < $prefixChangesNeeded; $i++) {
            $GLOBALS['prefix'] .= "../";
        }
        
        $controllerClass = new $routes[$key]();
        $controllerClass::index();
    } else {
        Error404Controller::index();
    }
    
    exit();
