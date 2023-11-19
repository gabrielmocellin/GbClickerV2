<?php
    include 'Controller/UserController.php';
    include 'Controller/ItemController.php';
    include 'Controller/ImportController.php';
    include 'Controller/LoginController.php';
    include 'Controller/ShopController.php';

    /* Ao utilizar o XAMPP é necessário colocar o "GbClickerV2" na url! */
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch($url){
        case '/':
            require "View/landingPage/landingPage.php";
            break;
        case '/login':
            LoginController::index();
            break;
        case '/register':
            UserController::form();
            break;
        case '/register/save':
            UserController::save();
            break;
        case '/home':
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
?>