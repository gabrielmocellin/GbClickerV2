<?php

namespace GbClicker\Controller;

class LogoutController
{
    public static function index()
    {
        session_start();
        session_unset();
        session_destroy();
        if (isset($_COOKIE['email-logado'])) {
            setcookie("email-logado", "", time() - 3600);
        }
        header("location: /login?aviso=2");
    }
}
