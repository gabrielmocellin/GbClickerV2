<?php

namespace GbClicker\Controller\User;

use GbClicker\Controller\Auth\LoginController;

class ConfigController
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

        $titulo = 'Configurações';
        $linksCss = [
            'css/adminpages.css',
            'css/config.css'
        ];
        $srcJs = [
            'js/Config/config.js'
        ];
        $conteudoMain = '../View/config/config.php';
        require_once '../src/Components/template.php';
    }
}
