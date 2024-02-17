<?php

namespace GbClicker\Controller;

class HomeController
{
    public static function index()
    {
        $model = LoginController::login();
        $conteudoMain = '../View/home/home.php';
        $srcJs = [
            'js/Home/home.js'
        ];
        require_once '../src/Components/template.php';
    }
}
