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
        include_once __DIR__ . "\\..\\..\\..\\View\\admin\\admin.php";
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
