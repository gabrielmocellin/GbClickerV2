<?php

namespace GbClicker\Controller\Game;
use GbClicker\Controller\Auth\LoginController;

class HomeController
{

    private LoginController $loginController;

    public function __construct(LoginController $loginController)
    {
        $this->loginController = $loginController;
    }
    public function index()
    {
        $model = $this->loginController->login();
        
        if ($model == null) {
            header("location: /login?aviso=1", true);
            exit;
        }
        
        $conteudoMain = '../View/home/home.php';
        $srcJs = ['js/Home/home.js'];
        require_once '../src/Components/template.php';
    }
}
