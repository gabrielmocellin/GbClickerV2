<?php

namespace GbClicker\Controller\Admin;

use GbClicker\Controller\Auth\LoginController;

class AdminPageController
{

    private LoginController $loginController;

    public function __construct(LoginController $loginController)
    {
        $this->loginController = $loginController;
    }
    public function index()
    {
        $model = $this->verifyAdminAccount();
        $titulo = 'Admin';
        $linksCss = ['css/admin.css', 'css/adminpages.css'];
        $conteudoMain = '../View/admin/admin.php';
        require_once '../src/Components/template.php';
    }

    public function verifyAdminAccount()
    {
        $model = $this->loginController->login();

        if ($model == null) {
            header("location: /login?aviso=1", true);
            exit;
        }

        if ($model->getTipoConta() === "ADMIN") {
            return $model;
        }

        header("location: \\login?aviso=4", true);
        exit;
    }
}
