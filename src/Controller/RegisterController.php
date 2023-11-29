<?php

namespace GbClicker\Controller;

class RegisterController
{
    public static function index()
    {
        include __DIR__ . "/../../View/register/register.php";
    }

    public static function verificarAvisos()
    {
        if (isset($_GET['aviso'])) {
            $codigoDoAviso = $_GET['aviso'];
            echo "<script>registro.verificarAvisos('$codigoDoAviso')</script>";
        }
    }
}
