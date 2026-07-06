<?php

namespace GbClicker\Controller\Auth;

use GbClicker\Model\UserModel;
use GbClicker\Service\UserService;
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
    private UserService $userService;

    public function __construct(Request $request, Session $session, UserService $userService)
    {
        $this->request = $request;
        $this->session = $session;
        $this->userService = $userService;
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
        $model = null;
        
        if ($this->request->hasCookie('email-logado')) { // COOKIE LOGIN
            $email = $this->request->cookie('email-logado');
            $model = $this->userService->findByEmail($email);
        } elseif ($this->session->has('email')) { // SESSION LOGIN
            $email = $this->session->get('email');
            $model = $this->userService->findByEmail($email);
        } elseif (
            $this->request->hasPost('email-input') &&
            $this->request->hasPost('password-input')
        ) {
            $email = $this->request->post('email-input');
            $password = $this->request->post('password-input');
            
            $model = $this->userService->authenticateByEmailAndPassword($email, $password);

            if (!$model){ return null; }
            if ($this->request->hasPost('cookie-checkbox')){ setcookie("email-logado", $model->getEmail(), time()+86400); }
        } else {
            return null;
        }
        
        if ($model) {
            $this->session->set('email', $model->getEmail());
        }
        
        return $model;
    }
}
