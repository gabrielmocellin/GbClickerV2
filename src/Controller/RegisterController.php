<?php

namespace GbClicker\Controller;

class RegisterController
{
    public function index()
    {
        include __DIR__ . "/../../View/register/register.php";
    }

    public function verificarAvisos()
    {
        if (isset($_GET['aviso'])) {
            $codigoDoAviso = $_GET['aviso'];
            echo "<script>registro.verificarAvisos('$codigoDoAviso')</script>";
        }
    }
}
