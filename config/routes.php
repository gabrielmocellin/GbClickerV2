<?php
    return [
        "GET|/" => \GbClicker\Controller\LandingpageController::class,
        "GET|/login" => GbClicker\Controller\LoginController::class,
        "GET|/register" => GbClicker\Controller\RegisterController::class,
        "GET|/logout" => GbClicker\Controller\LogoutController::class,
        "GET|/shop" => GbClicker\Controller\ShopController::class,
        "GET|/home" => GbClicker\Controller\HomeController::class,
        "POST|/register/save" => GbClicker\Controller\SaveRegisterController::class,
        "POST|/home" => GbClicker\Controller\HomeController::class,
        "POST|/home/save" => GbClicker\Controller\SaveGameController::class,
        "POST|/items/save" => GbClicker\Controller\AdminController\SaveItemController::class,
        "GET|/items" => GbClicker\Controller\ItemController::class,
        "GET|/profile" => GbClicker\Controller\ProfileController::class,
        "GET|/admin" => GbClicker\Controller\AdminPageController::class,
        "GET|/ranking" => \GbClicker\Controller\RankingController::class,
    ];