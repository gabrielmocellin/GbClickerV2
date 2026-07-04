<?php

namespace GbClicker\Controller;

class LogoutController
{
    public function index()
    {
        self::destruirSessao();
        self::destruirCookie();
        header("location: /login?aviso=2");
    }

    public function destruirSessao()
    {

        session_unset();
        session_destroy();
    }

    public function destruirCookie()
    {
        if (isset($_COOKIE['email-logado'])) {
            setcookie("email-logado", "", time() - 3600);
        }
    }
}
