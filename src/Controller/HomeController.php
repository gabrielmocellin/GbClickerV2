<?php

namespace GbClicker\Controller;

class HomeController
{
    public static function index()
    {
        $model = LoginController::login();
        if ($model != null) {
            require_once __DIR__ . '/../../View/home/home.php';
        } else {
            header("location: \\login?aviso=1");
        }
    }
}
