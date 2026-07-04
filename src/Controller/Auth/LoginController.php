<?php

namespace GbClicker\Controller\Auth;

use GbClicker\Model\UserModel;
use GbClicker\Http\Request;
use GbClicker\Http\Session;

class LoginController
{
    const COOKIE_LOGIN = 1;
    const SESSION_LOGIN = 2;
    const INPUT_LOGIN_CREATE_COOKIE = 3;
    const INPUT_LOGIN = 4;

    private Request $request;
    private Session $session;

    public function __construct(Request $request, Session $session)
    {
        $this->request = $request;
        $this->session = $session;
    }

    public function index()
    {
        $isLoggedIn = $this->session->has('email') || $this->request->hasCookie('email-logado');

        if ($isLoggedIn) {
            header("location: /home");
            exit;
        }

        include_once __DIR__ . '/../../../View/login/login.php';
    }

    public function login()
    {
        $model = $this->returnModelDataFromLoginType();
        return $model;
    }

    public function dispararAvisos()
    {
        if ($this->request->hasGet('aviso')) {
            $codigoDoAviso = $this->request->get('aviso');
            echo "<script>login.verificarAvisos('$codigoDoAviso')</script>";
        }
    }

    public function isUserLogged()
    {
        if ($this->session->has('email')) {
            return true;
        }
        return false;
    }

    public function returnModelDataFromLoginType()
    {
        $model = new UserModel();
        
        if ($this->request->hasCookie('email-logado')) { // COOKIE LOGIN
            $model->setEmail($this->request->cookie('email-logado'));
            $model->getByEmail();
        } elseif ($this->session->has('email')) { // SESSION LOGIN
            $model->setEmail($this->session->get('email'));
            $model->getByEmail();
        } elseif (
            $this->request->hasPost('email-input') &&
            $this->request->hasPost('password-input')
        ) {
            $model->setEmail($this->request->post('email-input'));
            $model->setPassword($this->request->post('password-input'));

            if (!$model->dataFoundByEmailAndPassword()){ return null; }
            if ($this->request->hasPost('cookie-checkbox')){ setcookie("email-logado", $model->getEmail(), time()+86400); }
        } else {
            return null;
        }
        
        $this->session->set('email', $model->getEmail());
        
        return $model;
    }
}
