<?php

namespace GbClicker\Controller;

class LogoutController
{
    public static function index()
    {
        LogoutController::destruirSessao();
        LogoutController::destruirCookie();
        header("location: /login?aviso=2");
    }

    public static function destruirSessao()
    {
        session_start();
        session_unset();
        session_destroy();
    }

    public static function destruirCookie()
    {
        if (isset($_COOKIE['email-logado'])) {
            setcookie("email-logado", "", time() - 3600);
        }
    }
}
