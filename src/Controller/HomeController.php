<?php

namespace GbClicker\Controller;

class HomeController
{
    public static function index()
    {
        $model = LoginController::login();
        require_once __DIR__ . '/../../View/home/home.php';
    }
}
