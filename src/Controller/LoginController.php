<?php

namespace GbClicker\Controller;

use GbClicker\Model\UserModel;

class LoginController
{
    const COOKIE_LOGIN = 1;
    const SESSION_LOGIN = 2;
    const INPUT_LOGIN_CREATE_COOKIE = 3;
    const INPUT_LOGIN = 4;

    public static function index()
    {
        session_start();

        $isLoggedIn = session_status() == 2 && (isset($_SESSION['email']) || isset($_COOKIE['email-logado']));

        if ($isLoggedIn) {
            header("location: /home");
            exit;
        }

        include_once __DIR__ . '/../../View/login/login.php';
    }

    public static function login()
    {
        session_start();
        $model = LoginController::returnModelDataFromLoginType();
        return $model;
    }

    public static function dispararAvisos()
    {
        if (isset($_GET['aviso'])) {
            $codigoDoAviso = $_GET['aviso'];
            echo "<script>login.verificarAvisos('$codigoDoAviso')</script>";
        }
    }

    public static function isUserLogged()
    {
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }

        if (isset($_SESSION['email'])) {
            return true;
        }
        return false;
    }

    public static function returnModelDataFromLoginType()
    # Essa função é utilizada para popular com os dados recuperados do banco o
    # objeto UserModel. Caso os dados não tenham sido encontrados, será retornado "null",
    # caso tenham sido encontrados os dados, o objeto preenchido será retornado.
    {
        $model = new UserModel();
        

        if (isset($_COOKIE['email-logado'])) { // COOKIE LOGIN
            $model->setEmail($_COOKIE['email-logado']);
            $model->getByEmail();
        } elseif (isset($_SESSION['email'])) { // SESSION LOGIN
            $model->setEmail($_SESSION['email']);
            $model->getByEmail();
        } elseif (
            isset($_POST['email-input']) &&
            isset($_POST['password-input'])
        ) {
            $model->setEmail($_POST['email-input']);
            $model->setPassword($_POST['password-input']);

            if (!$model->dataFoundByEmailAndPassword()){ return null; }
            if (isset($_POST['cookie-checkbox'])){ setcookie("email-logado", $model->getEmail(), time()+86400); }

            $_POST = array(); # Limpando os dados armazenados na superglobal $_POST
        } else {
            return null;
        }
        $_SESSION['email'] = $model->getEmail();
        
        return $model;
    }
}
