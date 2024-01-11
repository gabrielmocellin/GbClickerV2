<?php

namespace GbClicker\Controller;

class HomeController
{
    public static function index()
    {
        $model = LoginController::login();
        include_once __DIR__ . '/../../View/home/home.php';
    }
}
