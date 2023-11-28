<?php

namespace GbClicker\Controller;

class LogoutController
{
    public static function index()
    {
        session_start();
        session_unset();
        session_destroy();
        header("location: /?sessao=0");
    }
}
