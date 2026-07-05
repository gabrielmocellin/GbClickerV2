<?php

namespace GbClicker\Controller\Auth;

use GbClicker\Http\Request;

class RegisterController
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        include __DIR__ . "/../../../View/register/register.php";
    }

    public function verificarAvisos()
    {
        if ($this->request->hasGet('aviso')) {
            $codigoDoAviso = $this->request->get('aviso');
            echo "<script>registro.verificarAvisos('$codigoDoAviso')</script>";
        }
    }
}
