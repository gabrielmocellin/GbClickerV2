<?php

namespace GbClicker\Controller\Auth\Actions;

use GbClicker\Http\Request;
use GbClicker\Http\Session;

class LogoutController
{
    private Session $session;
    private Request $request;

    public function __construct(Session $session, Request $request)
    {
        $this->session = $session;
        $this->request = $request;
    }

    public function index()
    {
        $this->destruirSessao();
        $this->destruirCookie();
        header("location: /login?aviso=2");
    }

    public function destruirSessao()
    {

        $this->session->destroy();
    }

    public function destruirCookie()
    {
        if ($this->request->hasCookie('email-logado')) {
            setcookie("email-logado", "", time() - 3600);
        }
    }
}
