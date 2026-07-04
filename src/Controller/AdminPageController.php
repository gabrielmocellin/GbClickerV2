<?php

namespace GbClicker\Controller;

use GbClicker\Controller\LoginController;

class AdminPageController
{
    public function index()
    {
        $model = (new AdminPageController())->verifyAdminAccount();
        include_once __DIR__ . "\\..\\..\\View\\admin\\admin.php";
    }

    public function verifyAdminAccount()
    {
        $model = (new LoginController())->login();

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
