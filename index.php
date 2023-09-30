<?php
    include 'Controller/UserController.php';
    include 'Controller/ItemController.php';
    /* Ao utilizar o XAMPP é necessário colocar o "GbClickerV2" na url! */
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch($url){
        case '/':
            require "View/pages/landingPage/landingPage.html";
            break;
        case '/login':
            UserController::login();
            break;
        case '/register':
            UserController::form();
            break;
        case '/register/save':
            UserController::save();
            break;
        case '/home':
            UserController::index();
            break;
        case '/shop':
            UserController::shop();
            break;
        case '/items':
            ItemController::index();
            break;
        case '/logout':
            UserController::logout();
            break;
        default:
            echo "<h1>Página não encontrada!</h1>";
            echo "<h3>$url</h3>";
            break;
    }
?>