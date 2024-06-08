<?php

namespace GbClicker\Controller;

class HomeController
{
    public static function index()
    {
        $model = LoginController::login();
        
        if ($model == null) {
            header("location: /login?aviso=1", true);
            exit;
        }
        
        $conteudoMain = '../View/home/home.php';
        $srcJs = [
            'js/Home/home.js'
        ];
        require_once '../src/Components/template.php';
    }
}
