<?php

namespace GbClicker\Controller;

use GbClicker\Controller\LoginController;

class AdminPageController
{
    public static function index()
    {
        $model = AdminPageController::verifyAdminAccount();
        if ($model !== false) {
            include_once __DIR__ . "\\..\\..\\View\\admin\\admin.php";
            return;
        }
        header("location: \\login?aviso=1");
        return;
    }

    public static function verifyAdminAccount()
    {
        $model = LoginController::login();
        if (
            $model != null &&
            $model->getTipoConta() === "ADMIN"
            ) {
            return $model;
        }
        return false;
    }
}