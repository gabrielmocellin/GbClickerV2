<?php

namespace GbClicker\Controller;

use GbClicker\Model\UserModel;

class LoginController
{
    public static function index()
    {
        session_start();
        if (session_status() == 2) {
            if (
                (isset($_SESSION['email']) || isset($_COOKIE['email-logado'])) &&
                session_status() == 2 &&
                !isset($_GET['aviso'])
            ) {
                header("location: /home");
            }
        }
        include_once __DIR__ . '/../../View/login/login.php';
    }

    public static function login()
    {
        define("COOKIE_LOGIN", 1);
        define("SESSION_LOGIN", 2);
        define("INPUT_LOGIN_CREATE_COOKIE", 3);
        define("INPUT_LOGIN", 4);

        LoginController::verificarSessao();
        $tipoLogin = LoginController::verificarTipoLogin();
        $model = LoginController::efetuarLoginAPartirDoTipo($tipoLogin);

        if ($model == null) {
            header("location: /login?aviso=1");
        }

        return $model;
    }

    public static function verificarAvisos()
    {
        if (isset($_GET['aviso'])) {
            $codigoDoAviso = $_GET['aviso'];
            echo "<script>login.verificarAvisos('$codigoDoAviso')</script>";
        }
    }

    public static function verificarSessao()
    {
        session_start();
        if (session_status() !== 2) {
            header("location: /login?erro=3");
        }
    }

    public static function verificarTipoLogin()
    {
        if (isset($_COOKIE['email-logado'])) {
            return COOKIE_LOGIN;
        } elseif (isset($_SESSION['email'])) {
            return SESSION_LOGIN;
        } elseif (
            isset($_POST['email-input']) &&
            isset($_POST['password-input'])
        ) {
            if (
                isset($_POST['cookie-checkbox']) &&
                $_POST['cookie-checkbox'] === 'on'
            ) {
                return INPUT_LOGIN_CREATE_COOKIE;
            }
            return INPUT_LOGIN;
        } else {
            return 0;
        }
    }

    public static function efetuarLoginAPartirDoTipo($tipoLogin)
    {
        $model = new UserModel();

        switch ($tipoLogin){
            case COOKIE_LOGIN:
                $model->setEmail($_COOKIE['email-logado']);
                $model->getByEmail();
                $_SESSION['email'] = $model->getEmail();
                return $model;
            case SESSION_LOGIN:
                $model->setEmail($_SESSION['email']);
                $model->getByEmail();
                $_SESSION['email'] = $model->getEmail();
                return $model;
            case INPUT_LOGIN_CREATE_COOKIE:
                $email = $_POST['email-input'];
                $model->setEmail($_POST['email-input']);
                $model->setPassword($_POST['password-input']);
                if (!$model->getByEmailAndPassword()) {
                    return null;
                };
                setcookie("email-logado", $model->getEmail(), time()+86400);
                $_SESSION['email'] = $model->getEmail();
                $_POST = array();
                return $model;
            case INPUT_LOGIN:
                $email = $_POST['email-input'];
                $model->setEmail($email);
                $model->setPassword($_POST['password-input']);

                if ($model->getByEmailAndPassword()) {
                    $_SESSION['email'] = $email;
                    $_POST = array();
                    return $model;
                };
                return null;
            default:
                return null;
        }        
    }
}
