<?php

namespace GbClicker\Controller;

use GbClicker\Controller\LoginController;

class AdminPageController
{
    public static function index()
    {
        $model = AdminPageController::verifyAdminAccount();
        include_once __DIR__ . "\\..\\..\\View\\admin\\admin.php";
    }

    public static function verifyAdminAccount()
    {
        $model = LoginController::login();

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
